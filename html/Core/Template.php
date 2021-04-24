<?php

namespace Core;

class Template {

    public function __construct() {}

    public function get($templateFile, $data = []) {
        ob_start();
        extract($data);
        require(BASE_DIR . '/View/Template/' . basename($templateFile));
        return ob_get_clean();
    }

}
