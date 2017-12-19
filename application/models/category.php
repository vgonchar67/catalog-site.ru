<?php 
namespace App\models;

use Propel\Runtime\Connection\ConnectionInterface;

class Category extends \Propel\Category {

	public function preSave(ConnectionInterface $con = null) {
		return $this->validate();
	}

	public function getErrors() {
		$errors = array();
		foreach ($this->getValidationFailures() as $failure) {
			if(empty($errors[$failure->getPropertyPath()])) {
				$errors[$failure->getPropertyPath()] = $failure->getMessage();
			}
		}
		return $errors;
	}
	
}