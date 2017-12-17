<?php



class Captcha {
		
	static function create() {
		
		require_once 'application/lib/kcaptcha/kcaptcha.php';
		
		$captcha = new KCAPTCHA();
		$_SESSION['captcha_keystring'] = $captcha->getKeyString();
	}

	static function check($captcha, ErrorHandler $errorHandler) {
		if($captcha == '') {
			$errorHandler->addError('captcha', 'Введите текст с картинки');
		}
		if($captcha != $_SESSION['captcha_keystring']) {
			$errorHandler->addError('captcha', 'Попробуйте ещё раз');
		}
		
		unset($_SESSION['captcha_keystring']);
	}
}

