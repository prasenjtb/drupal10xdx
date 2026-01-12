<?php

namespace Drupal\customized\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
//use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'Custom Form' Block.
 *
 * @Block(
 *   id = "custom_form_block",
 *   admin_label = @Translation("Custom Form Block"),
 *   category = @Translation("Custom")
 * )
 */  
class CustomFormBlock extends BlockBase {   //implements ContainerFactoryPluginInterface
  
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    // Add any custom configuration fields here if needed.

    $config = $this->getConfiguration();

    $form['org_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Organization:'),
      '#default_value' => isset($config['org_name'])? $config['org_name'] : '',
    );

    // $form['actions']['custom_submit'] = [
    //   '#type' => 'submit',
    //   '#name' => 'custom_submit',
    //   '#value' => $this->t('Custom Submit'),
    //   '#submit' => [[$this, 'custom_submit_form']],
    // ];

    return $form;
  }

  /**
   * Custom submit actions.
   */
  // public function custom_submit_form($form, FormStateInterface $form_state) {
  //   $values = $form_state->getValues();
  //   // Perform the required actions.
  // }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    //parent::blockSubmit($form, $form_state);
    // Save custom configuration values here if needed.
    //$this->configuration['message'] = $form_state->getValue('message');
    $this->setConfigurationValue('org_name', $form_state->getValue('org_name'));
  }

  public function build() {
    $config = $this->getConfiguration();

    $org_name = isset($config['org_name']) ? $config['org_name'] : '';

    return [
      //'#markup' => $this->configuration['message'],
      '#markup' => $this->t('@org', array('@org'=> $org_name)),
      '#cache' => [
        'max-age' => 60000,
        'tags' => ['user: administer'],
        'contexts' => ['user'],
        //'contexts' => ['url.path', 'url.query_args']
      ],
    ];    
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    $org_name = $form_state->getValue('org_name');

    if (is_numeric($org_name)) {
      drupal_set_message('needs to be an integer', 'error');
      $form_state->setErrorByName('org_name', t('Organization name should not be numeric'));
    }
  }      
      
}