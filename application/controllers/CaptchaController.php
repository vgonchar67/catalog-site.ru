<?php
namespace gbook\controllers;

use gbook\core\Controller;

class CaptchaController extends Controller {
	
	public function indexAction() {
		CAPTCHA::create();
		exit;
	}
}

