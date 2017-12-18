<?php 
namespace app\models;

use app\core\Validator;
use app\core\DB;
use app\core\ErrorHandler;

class Category {

	const UNKNOWN_ERROR = 'Неизвестная ошибка';
	const TABLE_NAME = 'category';
	static $fields = ['id', 'name', 'preview_text', 'detail_text', 'active'];

	private $_rules = [
		'name' => [
			'.' => 'Введите имя',
			'.{3,}' => 'Минимум 3 символа'
		]
	];


	/**
	 * Добавляет категорию
	 * 
	 * @param array $values - комментарий
	 * @return boolean
	 */
	public function add($values, ErrorHandler $errorHandler) {

		$validator = new Validator($errorHandler);
		$validator->check($values, $this->_rules);
		
		if ($errorHandler->hasError()) {
			return false;
		}
		

		$db = DB::getInstance();
		$query = 'INSERT INTO `category`(`name`, `active`) VALUES (?, ?);';
		
		$sth = $db->prepare($query);
		
		$result = $sth->execute([
			$values['name'],
			(int)$values['active'],
		]);

		
		if (!$result) {
			$errorHandler->addError('common', self::UNKNOWN_ERROR);
		}
		
		return (bool)$db->lastInsertId();
	}
	
	public function update($id, $values, ErrorHandler $errorHandler) {
		
		$validator = new Validator($errorHandler);
		
		$validator->check($values, $this->_rules);
		
		if ($errorHandler->hasError()) {
			return false;
		}
		
		$db = DB::getInstance();
		$query = 'UPDATE `category` SET `name`= ?, `active` = ? WHERE `id`= ? ;';		
		$sth = $db->prepare($query);
		
		$result = $sth->execute([
			$values['name'],
			(int)$values['active'],
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
	
	

	static function getList($currentPage = 1, $limit = 2, array $filter = array()) {

		$currentPage = (int)$currentPage < 1 ? 1 : (int)$currentPage;
		
		$db = DB::getInstance();
		$offset = ($currentPage - 1) * $limit;
		$where = '';
		foreach ($filter as $k => $v) {
			if(in_array($k, self::$fields)) {
				$where .=  $k . ' = ' . $db->quote($v) . ',';
			}
		}
		if(!empty($where)) {
			$where = "WHERE " . substr($where,0,-1);
		}
	
		$query = "SELECT `id`, `name` ,`preview_text`, `detail_text`, `active` FROM `".self::TABLE_NAME."` $where LIMIT $limit OFFSET $offset";
		return $db->query($query, \PDO::FETCH_ASSOC)->fetchAll();

	}

	static function getCount() {
		$db = DB::getInstance();
		$query = 'SELECT count(1) FROM category';
		return $db->query($query)->fetchColumn();
	}
	
	static function getById($id) {
		$db = DB::getInstance();
		$query = 'SELECT `id`, `name`, `preview_text`, `detail_text`, `active` FROM `category` WHERE `id` = ?';
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
		
		$query = "SELECT COUNT(1)+1 FROM `category` WHERE `$sortBy` $sign (SELECT `$sortBy` FROM `category` WHERE id = ?);";
		
		$sth = $db->prepare($query);
		$sth->execute([$id]);
		$count = $sth->fetchColumn();
		return ceil($count/$limit);
		
	}

}