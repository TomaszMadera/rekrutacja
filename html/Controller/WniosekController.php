<?php

namespace Controller;

use Core\Controller;
use Core\Template;
use Model\WniosekModel;

class WniosekController {

    private $controller;
    private $template;
    private $wniosekModel;

    public function __construct() {
        $this->controller = new Controller();
        $this->template = new Template();
        $this->wniosekModel = new WniosekModel();
    }

    public function index() {
        $data = [];
        $data['form_sent'] = 0;
        $data['errors'] = false;

        if ($_POST) {
            $validation = 1;

            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['data_od'])) {
                $validation = 0;
                $data['errors']['data_od'] = 1;
            } 

            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['data_do'])) {
                $validation = 0;
                $data['errors']['data_do'] = 1;
            } 

            if ($validation) {
                if ($this->wniosekModel->add($_POST)) {
                    $data['form_sent'] = 1;
                }
            }
        }       

        $data['typ_id'] = isset($_POST['typ_id']) ? $_POST['typ_id'] : '';
        $data['data_od'] = isset($_POST['data_od']) ? $_POST['data_od'] : '';
        $data['data_do'] = isset($_POST['data_do']) ? $_POST['data_do'] : '';
        $data['komentarz'] = isset($_POST['komentarz']) ? $_POST['komentarz'] : '';

        $Auth = \Core\Auth::getInstance();
        $data['user_data'] = $Auth->getUserData();

        $data['typy'] = $this->wniosekModel->getTyp();
        
        $data['header'] = $this->controller->get('HeaderController');
        $data['footer'] = $this->controller->get('FooterController');
        echo $this->template->get('Wniosek.phtml', $data);
    }
}