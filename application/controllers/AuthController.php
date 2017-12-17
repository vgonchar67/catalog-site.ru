<?php
namespace gbook\controllers;

use gbook\core\Controller;
use \gbook\core\Response;
use gbook\models\Auth;

class AuthController extends Controller {
	
	function logoutAction () {
		Auth::logout();
		
		$redirect = $this->request->server['HTTP_REFERER'];
		
		if(empty($redirect)) {
			$redirect = '/';
		}
		
		Response::redirect($redirect);
	}
}

