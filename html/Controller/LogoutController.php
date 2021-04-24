<?php

namespace Controller;

use Core\Auth;

class LogoutController {

    private $auth;

    public function __construct() {        
        $this->auth = Auth::class;
    }

    public function index() {
        $Auth = $this->auth::getInstance();
        $Auth->logout();
        header('Location: ' . BASE_URL);
        exit;
    }
    
}