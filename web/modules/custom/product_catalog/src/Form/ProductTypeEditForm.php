<?php

namespace Drupal\product_catalog\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

class ProductTypeEditForm extends EntityEditForm {

  public function form(array $form, FormStateInterface $form_state) {
    $type = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => t('Label'),
      '#default_value' => $type->label(),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $type->id(),
      '#machine_name' => ['exists' => '\Drupal\product_catalog\Entity\ProductType::load'],
      '#disabled' => !$type->isNew(),
    ];

    return parent::form($form, $form_state);
  }

  public function save(array $form, FormStateInterface $form_state) {
    $type = $this->entity;
    $type->save();
    $this->messenger()->addMessage("Product type saved.");
    $form_state->setRedirect('entity.product_type.collection');
  }

}