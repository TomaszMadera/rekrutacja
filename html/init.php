<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

function autoload($classPath) {
    $classPath = BASE_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $classPath) . '.php';
    require_once $classPath;
}

spl_autoload_register('autoload');