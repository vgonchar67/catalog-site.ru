<?php
namespace App\core;

use App\core\ErrorHandler;

class Model {
	public $application;
	
	const TABLE_NAME = '';
	static $fields = [];

	function __construct(int $id = 0) {
		$this->errorHandler = new ErrorHandler;
		

		if(!empty($id)) {
			$db = DB::getInstance();

		}

	}
	
	
	
}
