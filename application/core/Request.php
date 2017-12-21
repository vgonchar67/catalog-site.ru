<?php 
namespace App\core;

/**
 * Класс для работы с запросом
 */
class Request {
	
    public function __get($name) 
    {      
        if (!isset($this->$name)) {
			
			switch ($name) {
				case 'server':  $this->$name = isset($_SERVER) ? $_SERVER : array(); break;
				case 'request':  $this->$name = isset($_REQUEST) ? $_REQUEST : array(); break;
				case 'get':  $this->$name = isset($_GET) ? $_GET : array(); break;
				case 'post':  $this->$name = isset($_POST) ? $_POST : array(); break;
				case 'cookie':  $this->$name = isset($_COOKIE) ? $_COOKIE : array(); break;
				case 'files':  $this->$name = isset($_FILES) ? $_FILES : array(); break;
			}

        }

        return $this->$name;
    }
	
	public function isAjax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'; 
	}	
	

}