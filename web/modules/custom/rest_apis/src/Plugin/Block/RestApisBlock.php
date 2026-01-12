<?php

//
namespace Drupal\rest_apis\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface; // Optional, for configuration forms

/**
 * Provides a 'Your Custom Block' block.
 *
 * @Block(
 *   id = "rest_apis_block",
 *   admin_label = @Translation("Rest Api Block"),
 *   category = @Translation("Custom")
 * )
 */
class RestApisBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
	  
	$csrf_token = \Drupal::service('csrf_token')->get('rest');  
	  
	// Return a renderable array with your block content.
	return [
	  //'#markup' => $this->t('custom REST Apis block! : '.$csrf_token),
	  '#markup' => $this->t('Token : @csrf_token', [
        '@csrf_token' => $csrf_token,
      ]),
	];
	
  }

  /**
   * Optional: Build a configuration form for the block.
   */
  public function blockForm($form, FormStateInterface $form_state) {
	$form = parent::blockForm($form, $form_state);
	// Add form elements here, e.g., a text field for a custom message.
	$config = $this->getConfiguration();
	$form['message'] = [
	  '#type' => 'textfield',
	  '#title' => $this->t('Custom Message'),
	  '#default_value' => $config['message'] ?? $this->t('Default message'),
	];
	return $form;
  }

  /**
   * Optional: Save configuration from the form.
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
	$this->setConfigurationValue('message', $form_state->getValue('message'));
  }
  
  /**
	* {@inheritdoc}
	*/
	/*public function access(AccountInterface $account, $return_as_object = false) {
	  // Check if the user has the 'access content' permission.
	  if ($account->hasPermission('access content')) {
		return AccessResult::allowed();
	  }
	  return AccessResult::forbidden();
	}*/

}
