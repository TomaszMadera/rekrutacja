<?php

namespace Core;

class Router {

    private $controller;
    private $action;

    public function __construct() {
        if (isset($_SERVER['REDIRECT_URL']) && !empty($_SERVER['REDIRECT_URL'])) {
            $path = explode('/', trim($_SERVER['REDIRECT_URL'],'/'));
            $controller = $path[0];
            if (isset($path[1])) {
                $this->action = $path[1];
            } else $this->action = 'index';
        } else {
            $controller = '/';
            $this->action = 'index';
        }

        require_once(BASE_DIR . 'routes.php');

        if (isset($routes[$controller])) {
            $this->controller = $routes[$controller];
        } else {
            $this->controller = $routes['404'];
            $this->action = 'index';
        }
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

}