<?php 
namespace App\core;

class DB {

	static $_instance;

	private function __construct() {}

	static function getInstance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
		}
		return self::$_instance;
	}
	
	private function __clone() {}
	
	private function __wakeup() {}
}