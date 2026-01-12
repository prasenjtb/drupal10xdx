<?php

namespace Drupal\product_catalog\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Product add/edit forms.
 */
class ProductForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $is_new = $entity->isNew();

    $status = parent::save($form, $form_state);

    if ($status === SAVED_NEW) {
      $this->messenger()->addStatus(t('Product %label has been created.', [
        '%label' => $entity->label(),
      ]));
    }
    else {
      $this->messenger()->addStatus(t('Product %label has been updated.', [
        '%label' => $entity->label(),
      ]));
    }

    // Redirect to the product list page.
    $form_state->setRedirect('entity.product.collection');

    return $status;
  }

  // public function save(array $form, FormStateInterface $form_state) {
  //   $entity = $this->getEntity();
  //   $status = parent::save($form, $form_state);

  //   $this->messenger()->addMessage("Product saved");

  //   $form_state->setRedirect('entity.product.collection');
  // }

}