<?php

declare(strict_types=1);

namespace Drupal\custom_entity_example;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a custom_entity_node entity type.
 */
interface CustomEntityNodeInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
