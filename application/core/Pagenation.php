<?php 
namespace app\core;

class Pagenation {

	private $_currentPage, $_count, $_limit, $_countPages, $_link;
	private $_viewPages = 5;

	function __construct ($count, $limit, $currentPage=1, $link = '/') {

		$currentPage = (int)$currentPage <= 0 ? 1 : (int)$currentPage;
		$this->_count = $count;
		$this->_limit = $limit;
		$this->_link = $link;
		$this->_countPages = ceil($count/$limit);
		if($currentPage > $this->_countPages) {
			$currentPage = $this->_countPages;
		}
		$this->_currentPage = $currentPage;
	}

	function getHtml() {
		$view = new View;
		$view->set(['pages' => $this->getPagesArray()]);
		return $view->parse('/pagenation');
	}

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
				'link' => ($i == 1)? $this->_link : $this->_link.'?page=' . $i,
				'number' => $i,
				'active' => $i == $this->_currentPage
			];

			if($i == $this->_currentPage) {
				if($i > 1) {
					$result['prev']['disabled'] = false;
					$result['prev']['link'] = ($i - 1 == 1)? $this->_link : $this->_link.'?page=' . ($i - 1);
				}
				if($i < $this->_countPages) {
					$result['next']['disabled'] = false;
					$result['next']['link'] = $this->_link.'?page=' . ($i + 1);
				}
			}
		}

		return $result;
	}

	function getCurrentPage() {
		return $this->_currentPage;
	}
}