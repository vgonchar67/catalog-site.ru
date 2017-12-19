<?php

namespace App\models;
use App\core\Validator;
use App\core\ErrorHandler;
use App\core\DB;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Auth {
	static function userAuth ($login, $password, ErrorHandler $errorHandler) {
		$validator = new Validator($errorHandler);
		$validator->check(['login'=>$login,	'password' => $password	], 
			['login' => ['.' => 'Введите Login'], 'password' => ['.' => 'Введите Пароль']]);
		
		if($errorHandler->hasError()) {
			return false;
		}
		
		$db = DB::getInstance();
		
		$query = 'SELECT `login`, `password`, `role`, `id` FROM `vg_users` WHERE login = ? AND password = ?;';
		$sth = $db->prepare($query);

		$sth->execute([$login, md5($password)]);

		if($user = $sth->fetch(\PDO::FETCH_ASSOC)) {
			$_SESSION['USER'] = $user;
			return true;
		} else {
			$errorHandler->addError('common', 'Неверный логин или пароль');
			return false;
		}
		
	}
	
	static function isAdmin() {
		return !empty($_SESSION['USER']) && $_SESSION['USER']['role'] === 'admin';
	}
	
	static function isAuth() {
		return !empty($_SESSION['USER']);
	}
	
	static function logout () {
		session_destroy();
		session_unset();
	}
}