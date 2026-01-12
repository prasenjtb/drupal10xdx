<?php

    namespace Drupal\customized\Plugin\Block;

    use Drupal\Core\Block\BlockBase;
    use Drupal\Core\Form\FormStateInterface;
    //use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

    /**
     * Provides a 'Hello' Block.
     *
     * @Block(
     *   id = "hello_block",
     *   admin_label = @Translation("Hello Block"),
     *   category = @Translation("Custom")
     * )
     */  
    class HelloBlock extends BlockBase {   //implements ContainerFactoryPluginInterface


      /**
       * Construct the HelloBlock.
       */
      /*public function __construct(array $configuration, $plugin_id, $plugin_definition, MessengerInterface $messenger, AccountProxyInterface $current_user) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->messenger = $messenger;
        $this->currentUser = $current_user;
      }*/

      /**
       * {@inheritdoc}
       */
      public function build() {

        $currentUserService = \Drupal::service('customized.current_user_name');     //Custom SERVICE Object
        $currentUserName = $currentUserService->getCurrentUserName();

        $data = ['example_data' => 'This is some example data to cache.'];

        //\Drupal::cache('my_custom_bin')->set('my_key', $data, strtotime('+1 hour'));

        //$cache = \Drupal::cache('my_custom_bin')->get('my_key');


        //----------------------------
        //$cache = \Drupal::service('cache.my_custom_bin');

        // Set cache
        //$cache->set('test_key', ['message' => 'Hello example data to cache'], time() + 3600);

        // Get cache
        //$item = $cache->get('test_key');
        //$itemCache = \Drupal::cache('my_custom_bin')->get('test_key');

        // if ($item) {
        //   dump($item->data);
        // }

        // if ($itemCache) {
        //   dump($itemCache->data);
        // }

        return [
          '#markup' => $this->t('This is a custom block. Current User name is displaying through Custom SERVICE call - '.$currentUserName),
          '#cache' => [
            'contexts' => ['url.path'],
            //'tags' => ['node:' . $node->id()],
            'max-age' => \Drupal\Core\Cache\Cache::PERMANENT,
          ],
        ];    
        //Returns render array
      }

      
      /**
       * {@inheritdoc}
       */
      public function blockSubmit($form, FormStateInterface $form_state) {
        parent::blockSubmit($form, $form_state);
        // Save custom configuration values here if needed.
		    //$this->configuration['message'] = $form_state->getValue('message');
      }
    }