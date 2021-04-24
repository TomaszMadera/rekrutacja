<?php

namespace Core;

use Core\Db;

class Auth {
	
	private static $Instance = false;
	
	private $dbLink = false;
	private $sqlTable = 'user';
	private $sqlIdCol = 'user_id';
	private $sqlLoginCol = 'login';
	private $sqlPasswordCol = 'password';
	
	public $error = false;

    private $db;
	
	private function __construct() {
		$this->db = new Db();
	}

	private function __clone() {}
 
    public static function getInstance() {
        if ( self::$Instance == false ) {			
            self::$Instance = new Auth();
        }
        return self::$Instance;
    }
	
	public function login($login,$password) {		
		$stmt = $this->db->getLink()->prepare("
			SELECT 
				{$this->sqlIdCol}, 
				{$this->sqlLoginCol}, 
				{$this->sqlPasswordCol} 
			FROM {$this->sqlTable} 
			WHERE {$this->sqlLoginCol}=:login
		");
		$stmt->bindValue(':login', $login);
		
		if ( !$stmt ) {
			echo "\nPDO::errorInfo():\n";
			print_r($this->db->getLink()->errorInfo());
			return false;
		}
		$stmt->execute();
		
		if ( $stmt->rowCount() == 0 ) {
			$this->error = 'nouser';
			return false;
		} 
		
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		if ( md5($password) != $row[$this->sqlPasswordCol] ) {
			$this->error = 'wrongpassword';
			return false;
		}			
		
		$_SESSION['Auth']['user_id'] = $row[$this->sqlIdCol];
		return $row[$this->sqlIdCol];		
	}
	
	public function isLoggedIn() {
		if ( isset($_SESSION['Auth']['user_id']) ) return true;
		else return false;
	}
	
	public function getUserData() {
		$stmt = $this->db->getLink()->prepare("
			SELECT 
				u.{$this->sqlIdCol} AS id, 
				u.{$this->sqlLoginCol} AS username,
				u.name, u.surname, s.`value` as sex_value
			FROM {$this->sqlTable} u
			LEFT JOIN sex s ON s.sex_id=u.sex_id
			WHERE {$this->sqlIdCol}=:sqlIdCol
		");
		$stmt->bindValue(':sqlIdCol', $_SESSION['Auth']['user_id']);
		
		if ( !$stmt ) {
			echo "\nPDO::errorInfo():\n";
			print_r($this->db->getLink()->errorInfo());
			return false;
		}
		$stmt->execute();

		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $row;
	}
	
	public static function logout() {
		session_destroy();		
	}
	
}