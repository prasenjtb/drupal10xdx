<?php

namespace Drupal\customized\Service;

use Drupal\Core\Session\AccountProxy;

/**
 * @var Drupal\Core\Session\AccountProxy
 */

class CurrentUserName {
    
    protected $current_user;

    public function __construct(AccountProxy $currentUser){
        $this->current_user = $currentUser;
    }

    public function getCurrentUserName(){
        return $this->current_user->getDisplayName();
    }
}