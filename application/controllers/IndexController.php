<?php
namespace App\controllers;

use App\core\Controller;
use Propel\CategoryQuery;
use App\core\Pagenation;

class IndexController  extends Controller {

	const COUNT_ON_PAGE = 20;

	function indexAction () {

		$count = CategoryQuery::create()->filterByActive(1)->count();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);
		$categories = CategoryQuery::create()
			->filterByActive(1)
			->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE)
			->toArray();
		
		$this->view->set(['categories' => [
			'count'=> $count,
			'items' => $categories,
			'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

} 