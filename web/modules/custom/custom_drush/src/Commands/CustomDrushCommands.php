<?php

namespace Drupal\custom_drush\Commands;

use Drush\Commands\DrushCommands;

class CustomDrushCommands extends DrushCommands {

  /**
   * Outputs a greeting message.
   *
   * @command custom:greet
   * @param string $name
   *   The name to greet.
   * @option upper
   *   Convert the name to uppercase.
   * @usage custom:greet "Drupal Developer"
   *   Outputs "Hello, Drupal Developer!"
   * @usage custom:greet "Drupal Developer" --upper
   *   Outputs "Hello, DRUPAL DEVELOPER!"
   */
  public function greet($name = 'world', $options = ['upper' => FALSE]) {
    if ($options['upper']) {
      $name = strtoupper($name);
    }
    $this->output()->writeln("Hello, $name!");
  }



    // protected Connection $database;
    // protected $configFactory;


    // /**
    // * Dependency Injection Constructor.
    // */
    // public function __construct(Connection $database, ConfigFactoryInterface $configFactory) {
    // parent::__construct();
    // $this->database = $database;
    // $this->logger = $logger_factory->get('custom_drush');
    // }


    /**
    * DI Container Create()
    */
    // public static function create(ContainerInterface $container) {
    //     return new static(
    //         $container->get('database'),
    //         $container->get('logger.factory'),
    //         $container->get('config.factory')
    //     );
    // }


    /**
    * Simple Hello Command
    * Run: drush custom:hello
    */
    //#[CLI\Command(name: 'custom:hello', description: 'Prints Hello World')]
    public function hello() {
        $this->io()->success('Hello World! Custom Drush Commands are working.');
    }


    /**
    * Command with argument & option
    * Run: drush custom:greet John --yell
    */
    // #[CLI\Command(name: 'custom:greet', description: 'Greets a user.')]
    // #[CLI\Argument(name: 'name', description: 'Person to greet')]
    // #[CLI\Option(name: 'yell', description: 'Return greeting in uppercase')]
    // public function greet($name, array $options = ['yell' => FALSE]) {
    //     $message = "Hello, $name!";


    //     if (!empty($options['yell'])) {
    //         $message = strtoupper($message);
    //     }


    //     $this->io()->success($message);
    // }
}