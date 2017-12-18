<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\core\Pagenation;

class adminController  extends Controller {

	const COUNT_ON_PAGE = 20;

	function indexAction () {

		/*$count = Comment::getCount();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);

		$this->view->set(['comments' => [
			'count'=> $count,
			'items' => Comment::getList($pagenation->getCurrentPage(), self::COUNT_ON_PAGE),
			'pagenationHTML' =>  $pagenation->getHtml()
		]]);*/
	}

	function categoriesAction () {

		$count = Category::getCount();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);

		$this->view->set(['categories' => [
			'count'=> $count,
			'items' => Category::getList($pagenation->getCurrentPage(), self::COUNT_ON_PAGE),
			//'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

	function editCategoryAction ($id) {
		
		$id = (int)$id;
		$values = array();
		if(!empty($_POST)) {
			
			$category = new Category();
			if(!empty($id)) {
				if($category->update($id, $_POST, $this->errorHandler)) {
					$this->response->redirect('/admin/categories?page=' . $category->getPageById($id, self::COUNT_ON_PAGE));
				}
				$values = $_POST;
			} else {
				
				$id = $category->add($_POST, $this->errorHandler);
				
				if(!empty($id)) {
					$this->response->redirect('/admin/categories?page=' . $category->getPageById($id, self::COUNT_ON_PAGE));
				} 
			}
		} else {
			if(!empty($id)) {
				$values = Category::getById($id);
			}
		}

		$this->view->set(['category' => [
			'errors' => $this->errorHandler->getErrors(),
			'values' => $values
			//'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

} 