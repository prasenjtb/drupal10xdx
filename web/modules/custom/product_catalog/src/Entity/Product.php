<?php
declare(strict_types=1);

namespace Drupal\product_catalog\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityStorageInterface;
//use Drupal\product_catalog\ProductInterface;
use Drupal\user\EntityOwnerTrait;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * @ContentEntityType(
 *   id = "product",
 *   label = @Translation("Product"),
 *   bundle_label = @Translation("Product type"),
 *   bundle_entity_type = "product_type", *   
 *   handlers = {
 *     "list_builder" = "Drupal\product_catalog\ProductListBuilder",
 *     "views_data" = "Drupal\product_catalog\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\product_catalog\Form\ProductForm",
 *       "edit" = "Drupal\product_catalog\Form\ProductForm",
 *       "delete" = "Drupal\product_catalog\Form\ProductDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }     
 *   },   
 *   base_table = "product",
 *   admin_permission = "administer products",   
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "bundle" = "type",
 *     "label" = "name"
 *   },
 *   links = { 
 *     "add-form" = "/product/add/{product_type}",
 *     "add-page" = "/product/add",
 *     "canonical" = "/product/{product}",
 *     "edit-form" = "/product/{product}/edit",
 *     "delete-form" = "/product/{product}/delete",
 *     "collection" = "/admin/content/product"
 *   },
 *   field_ui_base_route = "entity.product_type.edit_form",
 *   bundle_entity_type = "product_type"
 * )
 */
class Product extends ContentEntityBase {  // implements ProductInterface 

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['type']->setLabel(t('Product type'));
    // $fields['type'] = BaseFieldDefinition::create('entity_reference')
    //  ->setLabel(t('Product type'))
    //  ->setReadOnly(TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product name'))
      ->setRequired(TRUE)
      ->setSettings(['max_length' => 255])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ]);

    $fields['price'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Price'))
      ->setSettings([
        'precision' => 10,
        'scale' => 2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 1,
      ]);

    return $fields;
  }

}