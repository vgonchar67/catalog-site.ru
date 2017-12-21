<?php
namespace App\core;

use App\Core\Uri;

class Router {
	
	private $_segments = [];
	
	function __construct($routes) {
		$uriPath = (new Uri())->getPath();
		
		foreach($routes as $pattern => $value) {
			
			if(preg_match("~^$pattern$~", $uriPath)) {
				$this->_segments = explode('/', preg_replace("~^$pattern$~", $value, $uriPath));
				break;
			}
		}
		
	}
	
	public function getControllerName() {
		return !empty($this->_segments[0]) ? $this->_segments[0] : '';	
	}
	
	public function getActionName() {
		return !empty($this->_segments[1]) ? $this->_segments[1] : '';		
	}
	
	public function getActionParams() {
		return array_slice($this->_segments, 2);
	}
	
	public function error404() {
		$this->_segments = ['site', 'error404'];
	}
}