<?php

declare(strict_types=1);

namespace Drupal\custom_entity_example\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the custom_entity_node type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "custom_entity_node_type",
 *   label = @Translation("custom_entity_node type"),
 *   label_collection = @Translation("custom_entity_node types"),
 *   label_singular = @Translation("custom_entity_node type"),
 *   label_plural = @Translation("custom_entity_nodes types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count custom_entity_nodes type",
 *     plural = "@count custom_entity_nodes types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\custom_entity_example\Form\CustomEntityNodeTypeForm",
 *       "edit" = "Drupal\custom_entity_example\Form\CustomEntityNodeTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\custom_entity_example\CustomEntityNodeTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer custom_entity_node types",
 *   bundle_of = "custom_entity_node",
 *   config_prefix = "custom_entity_node_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/custom_entity_node_types/add",
 *     "edit-form" = "/admin/structure/custom_entity_node_types/manage/{custom_entity_node_type}",
 *     "delete-form" = "/admin/structure/custom_entity_node_types/manage/{custom_entity_node_type}/delete",
 *     "collection" = "/admin/structure/custom_entity_node_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class CustomEntityNodeType extends ConfigEntityBundleBase {

  /**
   * The machine name of this custom_entity_node type.
   */
  protected string $id;

  /**
   * The human-readable name of the custom_entity_node type.
   */
  protected string $label;

}
