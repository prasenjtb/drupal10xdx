<?php

    namespace Drupal\product_catalog;

    use Drupal\views\EntityViewsData;

    /**
     * Provides Views data for Your Entity Type entities.
     */
    class ProductViewsData extends EntityViewsData {

      /**
       * {@inheritdoc}
       */
      public function getViewsData() {
        $data = parent::getViewsData();

        // Add custom fields, filters, sorts, relationships here.
        // For example, to add a custom field:
        // $data['your_entity_type_id']['your_custom_field'] = [
        //   'title' => $this->t('Custom Field'),
        //   'help' => $this->t('A custom field for Your Entity Type.'),
        //   'field' => [
        //     'id' => 'field',
        //     'real field' => 'your_custom_field_column_name',
        //   ],
        // ];

        return $data;
      }

    }