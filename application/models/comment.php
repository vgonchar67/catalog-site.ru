<?php 
namespace app\models;

use app\core\Validator;
use app\core\DB;
use app\core\ErrorHandler;
use app\core\HtmLawed;

class Comment {

	const STATUS_MODERATION = 0;
	const UNKNOWN_ERROR = 'Неизвестная ошибка';
	static $fields = ['id', 'user_name', 'homepage', 'status', 'email'];

	private $_rules = [
		'user_name' => [
			'.' => 'Введите имя',
			'.{3,}' => 'Минимум 3 символа'
		],
		'email' => [
			'.' => 'Введите E-mail',
			Validator::PREG_EMAIL => 'Некорректный Email'
		],
		'text' => [
			'.' => 'Введите текст сообщения',
			'.{5,}' => 'Минимум 5 символа'
		]
	];

	/**
	 * Добавляет комментарий
	 * 
	 * @param array $values - комментарий
	 * @return boolean
	 */
	public function add($values, ErrorHandler $errorHandler) {
		$values['text'] = HtmLawed::purify($values['text']);

		$validator = new Validator($errorHandler);
		$validator->check($values, $this->_rules);
		
		if ($errorHandler->hasError()) {
			return false;
		}
		
		$db = DB::getInstance();
		$query = 'INSERT INTO `vg_comments`(`text`, `status`, `user_name`, `homepage`, `email`) VALUES (?, ?, ?, ?, ?);';
		
		$sth = $db->prepare($query);
		
		$result = $sth->execute([
			$values['text'],
			self::STATUS_MODERATION,
			$values['user_name'],
			$values['homepage'],
			$values['email'],
		]);
		
		if (!$result) {
			$errorHandler->addError('common', self::UNKNOWN_ERROR);
		}
		
		return (bool)$db->lastInsertId();
	}
	
	public function update($id, $values, ErrorHandler $errorHandler) {
		
		$values['text'] = HtmLawed::purify($values['text']);

		$validator = new Validator($errorHandler);
		
		$validator->check($values, $this->_rules);
		
		if ($errorHandler->hasError()) {
			return false;
		}
		
		$db = DB::getInstance();
		$query = 'UPDATE `vg_comments` SET `text`= ?, `status` = ?, `user_name`= ? ,`homepage`= ?,`email`= ? WHERE `id`= ? ;';		
		$sth = $db->prepare($query);
		
		$result = $sth->execute([
			$values['text'],
			self::STATUS_MODERATION,
			$values['user_name'],
			$values['homepage'],
			$values['email'],
			$id
		]);
		
		if (!$result) {
			$errorHandler->addError('common', self::UNKNOWN_ERROR);
		}
		
		return $result;
	}
	
	static function delete($id) {
		$db = DB::getInstance();
		$query = 'DELETE FROM `vg_comments` WHERE id = ?';
		$sth = $db->prepare($query);
		return $sth->execute([$id]);
	}
	
	

	static function getList($currentPage = 1, $limit = 2) {

		$currentPage = (int)$currentPage < 1 ? 1 : (int)$currentPage;

		$db = DB::getInstance();
		$offset = ($currentPage - 1) * $limit;

		$query = 'SELECT `id`, `text`, `user_name`, `homepage`, `email` FROM `vg_comments` LIMIT ' . $limit . ' OFFSET ' . $offset;
		return $db->query($query, \PDO::FETCH_ASSOC)->fetchAll();

	}

	static function getCount() {
		$db = DB::getInstance();
		$query = 'SELECT count(1) FROM vg_comments';
		return $db->query($query)->fetchColumn();
	}
	
	static function getById($id) {
		$db = DB::getInstance();
		$query = 'SELECT `id`, `text`, `user_name`, `homepage`, `email` FROM `vg_comments` WHERE `id` = ?';
		$sth = $db->prepare($query);
		$sth->execute([$id]);
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}
	
	static function getPageById($id, $limit, $sort = ['id' => 'asc']) {
		$db = DB::getInstance();
		$sortBy = 'id';
		$sign = '<';
		foreach($sort as $key => $v) {
			if(in_array($key, self::$fields)) {
				$sortBy = $key;
			}
			if($v === 'desc') {
				$sign = '>';
			}
			break;
		}
		
		$query = "SELECT COUNT(1)+1 FROM `vg_comments` WHERE `$sortBy` $sign (SELECT `$sortBy` FROM `vg_comments` WHERE id = ?);";
		
		$sth = $db->prepare($query);
		$sth->execute([$id]);
		$count = $sth->fetchColumn();
		return ceil($count/$limit);
		
	}

}