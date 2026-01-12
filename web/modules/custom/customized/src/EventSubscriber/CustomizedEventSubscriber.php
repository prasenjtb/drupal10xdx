<?php

    namespace Drupal\customized\EventSubscriber;

    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\EventDispatcher\Event;
    use Drupal\Core\Messenger\MessengerInterface; // Example dependency

    /**
     * Class CustomizedEventSubscriber.
     */
    class CustomizedEventSubscriber implements EventSubscriberInterface {

      /**
       * The messenger service.
       *
       * @var \Drupal\Core\Messenger\MessengerInterface
       */
      protected $messenger;

      /**
       * Constructs a new CustomizedEventSubscriber object.
       *
       * @param \Drupal\Core\Messenger\MessengerInterface $messenger
       *   The messenger service.
       */
      public function __construct(MessengerInterface $messenger) {
        $this->messenger = $messenger;
      }

      /**
       * {@inheritdoc}
       */
      public static function getSubscribedEvents() {
        $events = [
          'user.login' => 'onUserLogin',
          // Add other events you want to subscribe to.
        ];
        return $events;
      }

      /**
       * React to a user login event.
       *
       * @param \Symfony\Component\EventDispatcher\Event $event
       *   The event object.
       */
      public function onUserLogin(Event $event) {
        // Example: Add a message when a user logs in.
        $account = $event->getAccount(); // Assuming the user.login event passes the account.
        $this->messenger->addStatus('Welcome back, ' . $account->getDisplayName() . '!');
      }

    }