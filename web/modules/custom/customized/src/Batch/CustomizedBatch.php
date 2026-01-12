<?php

namespace Drupal\customized\Batch;

class CustomizedBatch {

  public static function process($nid, &$context) {
    $context['message'] = t('Processing node @nid', ['@nid' => $nid]);
  }

  public static function finished($success, $results, $operations) {
    \Drupal::messenger()->addMessage(t('Batch completed.'));
  }
}