<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\core\Pagenation;
use app\exceptions\CoreException;

class CatalogController  extends Controller {

	const COUNT_ON_PAGE = 20;

	function indexAction () {

		$count = Category::getCount();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);
		$items = Category::getList($pagenation->getCurrentPage(), self::COUNT_ON_PAGE, array(
			'active' => '1'
		));

		$this->view->set(['categories' => [
			'count'=> $count,
			'items' => $items,
			//'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

	function categoryAction ($id) {
		$category = Category::getById($id);
		if(empty($category)) {
			throw new CoreException;
		}

		$this->view->set(['category' => $category]);
	}

} 