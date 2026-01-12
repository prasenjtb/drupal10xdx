<?php

namespace Drupal\node_batch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class NodeBatchForm extends FormBase {

  public function getFormId() {
    return 'node_batch_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['count'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of nodes'),
      '#default_value' => 50,
      '#min' => 1,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Create Nodes'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $count = $form_state->getValue('count');

    $batch = [
      'title' => $this->t('Creating nodes...'),
      'operations' => [],
      'finished' => 'node_batch_finished',
      'progress_message' => $this->t('Created @current of @total nodes'),
      'error_message' => $this->t('Node creation failed.'),
    ];

    for ($i = 1; $i <= $count; $i++) {
      $batch['operations'][] = [
        'node_batch_create_node',
        [$i],
      ];
    }

    batch_set($batch);
  }
}