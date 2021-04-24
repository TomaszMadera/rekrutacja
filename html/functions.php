<?php
function dd($variable) {
    switch (gettype($variable)) {
        case 'string':
        case 'boolean':
        case 'integer':
        case 'double':
            echo $variable . '<br />';
            break;
        default:
            echo '<pre>';
            print_r($variable);
            echo '</pre>';
            break;
    }
}
