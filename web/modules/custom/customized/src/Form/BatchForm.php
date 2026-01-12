<?php

namespace Drupal\customized\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class BatchForm extends FormBase {

  public function getFormId() {
    return 'customized_batch_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Run Batch'),
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $batch = [
      'title' => $this->t('Processing items...'),
      //'operations' => [],
      'operations' => [
            ['customized_process', [$nid]],
        ],
      'finished' => 'customized_finished',
      'progress_message' => $this->t('Processed @current out of @total'),
      'error_message' => $this->t('Batch has encountered an error.'),
    ];


    $batch2 = [
        'title' => t('Processing 2items'),
        'operations' => [
            [['\Drupal\customized\Batch\CustomizedBatch', 'process'], [$nid]],
        ],
        'finished' => ['\Drupal\customized\Batch\CustomizedBatch', 'finished'],
    ];

    // Add 100 operations
    // for ($i = 1; $i <= 100; $i++) {
    //   $batch['operations'][] = [
    //     'customized_process',
    //     [$i],
    //   ];
    // }

    batch_set($batch);
  }
}