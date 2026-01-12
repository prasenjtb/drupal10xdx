<?php

namespace Drupal\my_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

class MyEntityForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $status = parent::save($form, $form_state);

    if ($status == SAVED_NEW) {
      $this->messenger()->addMessage($this->t('New Entity %label has been created.', ['%label' => $entity->label()]));
    }
    else {
      $this->messenger()->addMessage($this->t('Entity %label has been updated.', ['%label' => $entity->label()]));
    }

    //$this->messenger()->addMessage($this->t('Saved @label', ['@label' => $entity->label()]));
    $form_state->setRedirect('entity.my_entity.collection');
  }
}