<?php

namespace Controller;

use Core\Controller;
use Core\Template;
use Core\Auth;

class LoginController {

    private $auth;
    private $controller;
    private $template;

    public function __construct() {        
        $this->auth = Auth::class;
        $this->controller = new Controller();
        $this->template = new Template();
    }

    public function index() {
        $data = [];

        $data['error'] = false;
        if ( $_POST ) {
            $Auth = $this->auth::getInstance();
            if ( $Auth->login($_POST['login'], $_POST['password']) ) {
                header('Location: ' . BASE_URL);
                exit;
            }
            $data['error'] = $Auth->error;
        }
        
        $data['header'] = $this->controller->get('HeaderController');
        $data['footer'] = $this->controller->get('FooterController');
        echo $this->template->get('Login.phtml', $data);
    }
}