<?php

namespace Drupal\customized\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class RouteSubscriber extends RouteSubscriberBase {

  protected function alterRoutes(RouteCollection $collection) {

    // Example: Change controller of user login route.
    // if ($route = $collection->get('user.login')) {
    //   $route->setDefault('_controller', '\Drupal\customized\Controller\CustomLoginController::login');
    // }

    // Example: Change title.
    // if ($route = $collection->get('entity.node.canonical')) {
    //   $route->setDefault('_title', 'Custom Node View');
    // }
  }

}