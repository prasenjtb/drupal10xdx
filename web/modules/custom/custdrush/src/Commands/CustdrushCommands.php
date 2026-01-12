<?php

namespace Drupal\custdrush\Commands;

#use Drush\Attributes as CLI;
use Drush\Commands\DrushCommands;
use Psr\Log\LoggerInterface;
// use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\customized\Service\GreetingService;
// use Drupal\Core\Config\ConfigFactoryInterface;
// use Symfony\Component\DependencyInjection\ContainerInterface;

class CustdrushCommands extends DrushCommands {
	
  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  protected LoggerChannelFactoryInterface $custLogger;
  protected GreetingService $greetingService;
  //protected $logger;

  /**
   * Constructs a new NodeCountCommands object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, LoggerChannelFactoryInterface $logger, GreetingService $greetingService) {
    
    parent::__construct();
    //$this->logger = $logger_factory->get('custdrush');
	  $this->entityTypeManager = $entityTypeManager;
    $this->custLogger = $logger;
    $this->greetingService = $greetingService;
  }
  
  /**
   * Say hello example command.
   *
   * @command custdrush:hell
   * @param string $name
   * @usage drush custdrush:hell Prasenjit
   * @process
   * @aliases 
   * @status
   * @extract
   */
  public function hell($name = 'World') {
    $this->logger()->info("Hello from Drush command Logger!");
    $this->io()->success("Hell, $name!");
  }

  /**
   * Count the number of nodes in the Drupal site.
   *
   * @command custdrush:node-count
   * @aliases node-count nc
   * @option type Filter nodes by type
   * @usage custdrush:node-count
   *   Display total number of nodes
   * @usage custdrush:node-count --type=article
   *   Count nodes of type 'article'
   *
   * @param array $options
   *   An array of options.
   *
   * @return int
   *   The number of nodes.
   */
  public function nodeCount($options = ['type' => null]) {
      // Validate node type if provided.
      if (!empty($options['type']) && !$this->entityTypeManager->getStorage('node_type')->load($options['type'])) {
          throw new \InvalidArgumentException("Node type '{$options['type']}' does not exist.");
      }

      // Get the node storage.
      $nodeStorage = $this->entityTypeManager->getStorage('node');
      $query = $nodeStorage->getQuery()->accessCheck(true);

      // Filter by node type if specified.
      if (!empty($options['type'])) {
          $query->condition('type', $options['type']);
      }

      // Execute the query and get the count.
      $count = $query->count()->execute();

      // Output the result.
      if (!empty($options['type'])) {
        $this->logger()->info("Total nodes of type '{$options['type']}': $count from Drush command!");  //Not Reflecting in Recent logs
        $this->custLogger->get('custdrush')->info("Total nodes of type '{$options['type']}': $count from Drush command!");
        $this->output()->writeln("Total nodes of type '{$options['type']}': $count");
          
      } else {
        $this->logger()->info("Total nodes $count from Drush command!");  //Not Reflecting in Recent logs
        $this->custLogger->get('custdrush')->info("Total nodes $count from Drush command!");
        $this->output()->writeln("Total nodes in the site: $count");
        
      }

      return $count;
    }

  /**
   * Say hello using custom service.
   *
   * @command custdrush:helloservice
   * @param string $name
   * @usage drush custdrush:helloservice Prasenjit
   */
  public function helloservice(string $name = 'Drupal'): void {
    $message = $this->greetingService->sayHello($name);
    $this->output()->writeln($message);
  }
  
  /**
   * Example with service.
   *
   * @command custdrush:count-nodes
   */
  // public function countNodes() {
  //   $count = $this->entityTypeManager
  //     ->getStorage('node')
  //     ->getQuery()
  //     ->count()
  //     ->execute();

  //   $this->logger->info("Node count: $count");
  //   $this->io()->success("Total nodes: $count");
  // }

  /**
   * A simple custom Drush command.
   *
   * Run using: drush custdrush:hello
   */
  # [CLI\Command(name: 'custdrush:hello', description: 'Prints Hello World from custdrush module')]
  public function hello() {
    $this->io()->success('Hello World! Custom custdrush Drush command is working.');
    //$this->logger()->info('This is a hello log message!');
  }

  /**
   * A command with arguments and options.
   *
   * Run:
   * drush custom:greet John --yell
   */
  # [CLI\Command(name: 'custom:greet', description: 'Greets a user')]
  # [CLI\Argument(name: 'name', description: 'Your name')]
  # [CLI\Option(name: 'yell', description: 'Make the greeting uppercase')]
  // public function greet($name, $options = ['yell' => FALSE]) {
  //   $message = "Hello $name! Welcome to Drupal 10";

  //   /*if ($options['yell']) {
  //     $message = strtoupper($message);
  //   }*/
  //   if (!empty($options['yell'])) {
  //     $message = strtoupper($message);
  //   }

  //   $this->io()->success($message);
  // }

   /**
   * A command with logging and return data.
   *
   * Usage:
   *   drush custdrush:log
   */
  # [CLI\Command(name: 'custdrush:log', description: 'Writes a message to Drupal logs')]
  // public function logExample() {
  //   $this->logger()->info('Custom custdrush Drush command executed!');

  //   return $this->io()->success('Log written to Drupal watchdog table.');
  // }

}