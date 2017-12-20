<?php
namespace App\controllers;

use App\core\Controller;
use Propel\CategoryQuery;
use Propel\ProductQuery;
use App\core\Pagenation;
use App\exceptions\CoreException;

class CatalogController  extends Controller {

	const COUNT_ON_PAGE = 20;

	function indexAction () {

		$q = CategoryQuery::create()->filterByActive(1);
		$pagenation = new Pagenation($q->count(), self::COUNT_ON_PAGE, $this->request->get['page']);
		$categories = $q->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE);
		
		$this->view->set([
			'categories' => $categories,
			'pagenationHTML' =>  $pagenation->getHtml()
		]);
	}

	function categoryAction ($id) {

		$category = CategoryQuery::create()->filterByActive(1)->findPK($id);
		if(empty($category)) {
			throw new CoreException;
		}
	
		$q = ProductQuery::create()
			->filterByActive(1)
			->filterByCategory($category);
		
		$pagenation = new Pagenation($q->count(), self::COUNT_ON_PAGE, $this->request->get['page']);
		$products = $q->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE);

		$this->view->set([
			'category' => $category,
			'products' => $products,
			'pagenationHTML' => $pagenation->getHTML()
		]);
	}

} 