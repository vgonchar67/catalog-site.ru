<?php

namespace gbook\core;

class Registry {
	
	protected $registry = [];
	
	public function __construct($registry = []) {
        $this->registry = $registry;
    }
	
	public function __get($name) {
        return isset($this->registry[$name]) ? $this->registry[$name] : null;
    }
	
	public function __set($name, $value) {
        $this->registry[$name] = $value;
    }
	
	
}
