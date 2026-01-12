<?php

namespace Drupal\custdrush\Commands;

use Drush\Commands\DrushCommands;
use Drupal\node\Entity\Node;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class ResaveNodesCommands extends DrushCommands {

  protected LoggerChannelFactoryInterface $custLogger;

  public function __construct(LoggerChannelFactoryInterface $logger) {
    
    parent::__construct();
    $this->custLogger = $logger;
  }


  /**
   * Re-save nodes in batches.
   *
   * @command custdrush:resave-nodes
   * @option type Content type (optional)
   * @option batch Batch size
   * @aliases rsvn
   */
  public function resaveNodes($options = [
    'type' => NULL,
    'batch' => 3,
  ]) {
    $query = \Drupal::entityQuery('node')
      ->accessCheck(FALSE);

    if ($options['type']) {
      $query->condition('type', $options['type']);
    }

    $nids = $query->execute();
    $chunks = array_chunk($nids, (int) $options['batch'], true);

    foreach ($chunks as $i => $chunk) {
      $nodes = Node::loadMultiple($chunk);

      foreach ($nodes as $node) {
        $node->setNewRevision(FALSE);
        $node->save();
      }

      $chunkArr = json_encode($chunk);

      $this->custLogger->get('custdrush')->info("Nodes of IDs $chunkArr : - {$options['batch']} nodes processed!");
      $this->output()->writeln("Batch " . ($i + 1) . " processed.");
    }

    $this->io()->success('All nodes re-saved successfully.');
  }

}