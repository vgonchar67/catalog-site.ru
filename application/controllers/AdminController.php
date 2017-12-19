<?php
namespace App\controllers;

use App\core\Controller;
use Propel\Category;
use Propel\CategoryQuery;
use Propel\Product;
use Propel\ProductQuery;
use App\core\Pagenation;
use App\Exceptions\CoreException;

class adminController  extends Controller {

	const COUNT_ON_PAGE = 5;

	function indexAction () {

	}

	function categoriesAction () {

		$count = CategoryQuery::create()->count();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);
		$categories = CategoryQuery::create()
			->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE)
			->toArray();
		
		$this->view->set(['categories' => [
			'count'=> $count,
			'items' => $categories,
			'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

	function productsAction () {

		$count = ProductQuery::create()->count();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);
		$products = ProductQuery::create()
			->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE)
			->toArray();
		
		$this->view->set(['products' => [
			'count'=> $count,
			'items' => $products,
			'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

	function editCategoryAction ($id) {

		$category = $id ? CategoryQuery::create()->findPK($id) : new Category();

		if(is_null($category)) {
			throw new CoreException;
		}

		if($this->request->post) {

			$category->setName(trim($this->request->post['Name']));
			$category->setActive((int)$this->request->post['Active']);
			$category->setPreviewText($this->request->post['PreviewText']);
			$category->setDetailText($this->request->post['DetailText']);

			if($category->validate()) {
				$category->save();
				$this->response->redirect('/admin/categories');
			}
		}
		
	
		$this->view->set(['category' => [
			'errors' => $category->getErrors(),
			'values' => $category->toArray()
		]]);
	}

	function editProductAction ($id) {

		$product = $id ? ProductQuery::create()->findPK($id) : new Product();

		if(is_null($product)) {
			throw new CoreException;
		}
		
		if($this->request->post) {

			$product->setName(trim($this->request->post['Name']));
			$product->setActive((int)$this->request->post['Active']);
			$product->setPreviewText($this->request->post['PreviewText']);
			$product->setDetailText($this->request->post['DetailText']);
			$product->setQuantity((int)$this->request->post['Quantity']);
			$product->setOrderEmptyQuantity((int)$this->request->post['OrderEmptyQuantity']);


			$categories = CategoryQuery::create()->findPKs($this->request->post['Categories']);
			$product->setCategories($categories);
						
			if($product->validate()) {
				$product->save();
				$this->response->redirect('/admin/products');
			}
		}

		$values = $product->toArray();
		$values['categories'] = $product->getCategories()->toArray('Id');

		$this->view->set(['product' => [
			'errors' => $product->getErrors(),
			'values' => $values,
			'categories' => CategoryQuery::getNamesArray()
		]]);
	}

} 