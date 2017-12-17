<?php

namespace gbook\core;

class ErrorHandler {

	private $_errors = [];
	
	public function addError($key, $errorText) {
		$this->_errors[$key][] = $errorText;
	}
	
	public function getErrors($key = null) {
		if($key === null) {
			return $this->_errors;
		}
		return $this->errors[$key];
	}
	
	public function hasError($key = null) {
		if($key === null) {
			return !empty($this->_errors);
		}
		return !empty($this->_errors[$key]);
	}

}