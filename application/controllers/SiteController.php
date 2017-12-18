<?php
namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller {
	
	public function error404Action () {
		$this->response->setHeader("HTTP/1.1 404 Not Found");
	}
}
