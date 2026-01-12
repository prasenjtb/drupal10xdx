<?php

namespace Drupal\customized\Service;

use Drupal\Core\Validation\EmailValidator;

class CustomEmailValidator extends EmailValidator {

  public function isValid($email, $strict = FALSE) {
    // Custom logic
    if (str_ends_with($email, '@test.com')) {
      return FALSE; // block test.com domain
    }
    return parent::isValid($email, $strict);
  }

} 