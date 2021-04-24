<?php

namespace Controller;

use Core\Template;

class HeaderController {

    private $template;

    public function __construct() {
        $this->template = new Template();
    }
    
    public function index() {
        $data = [];
        echo $this->template->get('Header.phtml', $data);
    }
}