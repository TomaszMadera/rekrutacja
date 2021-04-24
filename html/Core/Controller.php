<?php

namespace Core;

class Controller {

    public function __construct() {}

    public function output($controller, $action) {
        echo $this->get($controller, $action);
    }

    public function get($controller, $action = 'index') {
        $classPath = "\Controller\\" . $controller;
        $controller = new $classPath();
        ob_start();
        $controller->$action();
        return ob_get_clean();
    }
    
}