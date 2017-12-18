<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Category;
use app\core\Pagenation;

class IndexController  extends Controller {

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

} 