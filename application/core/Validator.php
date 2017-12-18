<?php 
namespace app\core;

class Validator {

	private $_errorHandler;

	function __construct(ErrorHandler $errorHandler) {
		$this->_errorHandler = $errorHandler;
	}

	public function check(array $values, array $rules) {
		foreach ($rules as $key => $rules) {
			foreach ($rules as $pattern => $error) {
				if(!preg_match("~$pattern~iD", $values[$key])) {
					$this->_errorHandler->addError($key, $error);
					break;
				}
			}
		}
	}
}