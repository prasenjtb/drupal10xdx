<?php

namespace Drupal\my_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * @ContentEntityType(
 *   id = "my_entity",
 *   label = @Translation("My Entity"),
 *   handlers = {
 *     "list_builder" = "Drupal\my_entity\MyEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\my_entity\Form\MyEntityForm",
 *       "edit" = "Drupal\my_entity\Form\MyEntityForm",
 *       "delete" = "Drupal\my_entity\Form\MyEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider"
 *     }
 *   },
 *   base_table = "my_entity",
 *   admin_permission = "administer my entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "title"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/my-entity/add",
 *     "edit-form" = "/admin/content/my-entity/{my_entity}/edit",
 *     "delete-form" = "/admin/content/my-entity/{my_entity}/delete",
 *     "collection" = "/admin/content/my-entity"
 *   }
 * )
 */
class MyEntity extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setSettings([
        'max_length' => 255,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'));

    return $fields;
  }
}