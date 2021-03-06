<?php 
namespace App\core;

use App\Core\Uri;

/**
 * Класс для работы с пагинацией
 */
class Pagenation {

	private $_currentPage, $_count, $_limit, $_countPages, $_link;
	private $_viewPages = 5;

	function __construct ($count, $limit, $currentPage=1) {

		$currentPage = (int)$currentPage <= 0 ? 1 : (int)$currentPage;
		$this->_count = $count;
		$this->_limit = $limit;
		$this->_countPages = ceil($count/$limit);
		if($currentPage > $this->_countPages) {
			$currentPage = $this->_countPages;
		}
		$this->_currentPage = $currentPage;
	}
	
	 /**
	  * Возвращает HTML код пагинации
	  *
	  * @return void
	  */
	function getHtml() {
		if($this->_countPages <=1 ) {
			return '';
		}
		$view = new View;
		$view->set(['pages' => $this->getPagesArray()]);
		return $view->parse('pagenation');
	}

	/**
	 * Возвращает данные для пагинации
	 *
	 * @return array
	 */
	function getPagesArray() {
		
		$left = round($this->_viewPages/2);
		$startPage = $this->_currentPage - $left + 1;

		if($startPage < 1) {
			$startPage = 1;
		}
		$endPage = $startPage + $this->_viewPages - 1;
		$maxPages = ceil($this->_count/$this->_limit);
		if($endPage > $this->_countPages) {
			$endPage = $this->_countPages;
		} 
		$startPage = $endPage - $this->_viewPages + 1;
		if($startPage < 1) {
			$startPage = 1;
		}

		$result = [
			'prev' => ['disabled' => true],
			'next' => ['disabled' => true],
			'items' => []
		];

		for($i = $startPage; $i <= $endPage; $i++) {

			$result['items'][] = [
				'link' => ($i == 1)? Uri::GetCurPageParam('', array('page')) : Uri::GetCurPageParam("page=$i", array('page')),
				'number' => $i,
				'active' => $i == $this->_currentPage
			];

			if($i == $this->_currentPage) {
				if($i > 1) {
					$result['prev']['disabled'] = false;
					$result['prev']['link'] = ($i - 1 == 1)? Uri::GetCurPageParam('', array('page')) : Uri::GetCurPageParam('page='.($i-1), array('page'));
				}
				if($i < $this->_countPages) {
					$result['next']['disabled'] = false;
					$result['next']['link'] =  Uri::GetCurPageParam('page='.($i+1), array('page'));
				}
			}
		}

		return $result;
	}

	function getCurrentPage() {
		return $this->_currentPage;
	}
}