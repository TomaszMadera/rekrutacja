<?php

namespace Core;

class Db {

    private $link;

    public function __construct() {
        try {
            $this->link = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) {                
            die("Database error: " . $e->getMessage());
        }
    }

    public function getLink() {
        return $this->link;
    }

}