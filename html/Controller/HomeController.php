<?php

namespace Controller;

use Core\Controller;
use Core\Template;
use Core\Auth;

class HomeController {
    
    private $controller;
    private $template;
    private $auth;

    public function __construct() { 
        $this->controller = new Controller();
        $this->template = new Template();
        $this->auth = Auth::class;
    }

    public function index() {
        $data = [];

        $Auth = $this->auth::getInstance();
        $data['user_data'] = $Auth->getUserData();
        
        $data['header'] = $this->controller->get('HeaderController');
        $data['footer'] = $this->controller->get('FooterController');
        echo $this->template->get('Home.phtml', $data);
    }
}