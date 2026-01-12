<?php
namespace Drupal\custdrush\Commands;

#use Drush\Attributes as CLI;
use Drush\Commands\DrushCommands;
use Psr\Log\LoggerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

/**
 * Provides Drush commands for content auditing.
 */
class ContentAuditCommands extends DrushCommands {

    protected $entityTypeManager;

    public function __construct(EntityTypeManagerInterface $entityTypeManager) {
        $this->entityTypeManager = $entityTypeManager;
    }

    /**
     * Audit taxonomy terms in a vocabulary.
     *
     * @command custom:audit-taxonomy
     * @option vocabulary The vocabulary machine name
     * @usage custom:audit-taxonomy --vocabulary=tags
     *   Audit all terms in the 'tags' vocabulary
     */
    public function auditTaxonomy($options = ['vocabulary' => 'tags']) {
        $termStorage = $this->entityTypeManager->getStorage('taxonomy_term');
        $query = $termStorage->getQuery()->accessCheck(true);
        $query->condition('vid', $options['vocabulary']);
        $termCount = $query->count()->execute();

        //node type doesn’t exist
        if (!empty($options['type']) && !$this->entityTypeManager->getStorage('node_type')->load($options['type'])) {
            throw new \InvalidArgumentException("Node type '{$options['type']}' does not exist.");
        }

        $this->output()->writeln("Total terms in '{$options['vocabulary']}': $termCount");
        return $termCount;
    }
}