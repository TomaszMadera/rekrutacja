<?php

namespace Model;

class WniosekModel {

    private $db;

    public function __construct() {        
        $this->db = new \Core\Db();
    }

    public function getTyp() {
        try {
            $statement = $this->db->getLink()->prepare("SELECT * FROM typ");
            $statement->execute();            
            $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Databese error: ' . $e->getMessage());
        }
        return $rows;
    }

    public function add($data) {
        try {
            $statement = $this->db->getLink()->prepare("
                INSERT INTO wniosek SET
                typ_id = :typ_id,
                data_od = :data_od,
                data_do = :data_do,
                komentarz = :komentarz
            ");
            $statement->bindParam(':typ_id', $data['typ_id'], \PDO::PARAM_INT);
            $statement->bindParam(':data_od', $data['data_od'], \PDO::PARAM_STR);
            $statement->bindParam(':data_do', $data['data_do'], \PDO::PARAM_STR);
            $statement->bindParam(':komentarz', $data['komentarz'], \PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $e) {
            die('Databese error: ' . $e->getMessage());
        }
        return true;
    }
}