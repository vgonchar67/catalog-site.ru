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
			'category' => $category->toArray(),
			'products' => $products->toArray()
		]);
	}

} 