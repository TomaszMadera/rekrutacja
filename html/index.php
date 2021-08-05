<?php

require_once('init.php');
require_once('config.php');
require_once('functions.php');

use Core\Router;
use Core\Controller;
use Core\Auth;

$Router = new Router();
$Controller = new Controller();

if ( !Auth::getInstance()->isLoggedIn() && $Router->getController() != 'LoginController' && $Router->getController() != 'NotFoundController' ) {
	header('Location: ' . BASE_URL . 'login');
}

$Controller->output($Router->getController(), $Router->getAction());

// test1
