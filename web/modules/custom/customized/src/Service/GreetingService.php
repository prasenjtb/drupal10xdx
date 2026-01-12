<?php

namespace Drupal\customized\Service;

class GreetingService {

  public function sayHello(string $name): string {
    return "Hello greeting {$name}!";
  }

}