<?php

namespace Drupal\product_catalog\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Product type configuration entity.
 * 
 * @ConfigEntityType(
 *   id = "product_type",
 *   label = @Translation("Product type"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\product_catalog\Form\ProductTypeForm",
 *       "edit" = "Drupal\product_catalog\Form\ProductTypeForm",
 *       "delete" = "Drupal\product_catalog\Form\ProductTypeDeleteForm"
 *     },
 *     "list_builder" = "Drupal\product_catalog\ProductTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer product types",
 *   config_prefix = "product_type",
 *   bundle_of = "product",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/product_types/add",
 *     "edit-form" = "/admin/structure/product_types/{product_type}/edit",
 *     "delete-form" = "/admin/structure/product_types/{product_type}/delete",
 *     "collection" = "/admin/structure/product_types"
 *   }
 * )
 */
class ProductType extends ConfigEntityBundleBase {
  /**
   * The machine ID of this product type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human readable label.
   *
   * @var string
   */
  protected $label;
}