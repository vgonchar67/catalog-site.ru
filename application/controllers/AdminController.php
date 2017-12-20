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
		
		$q = CategoryQuery::createWithGetFilter();

		$pagenation = new Pagenation($q->count(), self::COUNT_ON_PAGE, $this->request->get['page']);
		$categories = $q->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE);

		$this->view->set([
			'filter' => $_SESSION["category_filter_form"],
			'curUrlEncode' => urlencode($this->request->server['REQUEST_URI']),
			'categories' => $categories,
			'pagenationHTML' =>  $pagenation->getHtml()
		]);
	}

	function productsAction () {

		$count = ProductQuery::create()->count();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);
		$products = ProductQuery::create()
			->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE);
		
		$this->view->set([
			'curUrlEncode' => urlencode($this->request->server['REQUEST_URI']),
			'products' => $products,
			'pagenationHTML' =>  $pagenation->getHtml()
		]);
	}

	function editCategoryAction ($id) {
		$ref =$this->request->get["ref"];
		$ref = $ref ? $ref : '/admin/categories';

		$category = $id ? CategoryQuery::create()->findPK($id) : new Category();

		if(is_null($category)) {
			throw new CoreException;
		}

		if($this->request->post) {

			$category->setName(trim($this->request->post['name']));
			$category->setActive((int)$this->request->post['active']);
			$category->setPreviewText($this->request->post['preview_text']);
			$category->setDetailText($this->request->post['detail_text']);

			if($category->validate()) {
				$category->save();
				$this->response->redirect($ref);
			}
		}
		
	
		$this->view->set([
			'ref' => $ref,
			'errors' => $category->getErrors(),
			'category' => $category
		]);
	}

	function editProductAction ($id) {
		$ref =$this->request->get["ref"];
		$ref = $ref ? $ref : '/admin/categories';

		$product = $id ? ProductQuery::create()->findPK($id) : new Product();

		if(is_null($product)) {
			throw new CoreException;
		}
		
		if($this->request->post) {

			$product->setName(trim($this->request->post['name']));
			$product->setActive((int)$this->request->post['active']);
			$product->setPreviewText($this->request->post['preview_text']);
			$product->setDetailText($this->request->post['detail_text']);
			$product->setQuantity((int)$this->request->post['quantity']);
			$product->setEmptyOrder((int)$this->request->post['empty_order']);


			$categories = CategoryQuery::create()->findPKs($this->request->post['Categories']);
			$product->setCategories($categories);
						
			if($product->validate()) {
				$product->save();
				$this->response->redirect($ref);
			}
		}

		$this->view->set([
			'ref' => $ref,
			'errors' => $product->getErrors(),
			'product' => $product,
			'selectedCategories' => $product->getCategories()->toArray('Id'),
			'categories' => CategoryQuery::create()->find()
		]);
	}

	public function deleteCategoryAction() {

		if($this->request->post["id"]) {

			CategoryQuery::create()->findPK($this->request->post["id"])->delete();

			$this->response->redirect($_SERVER["HTTP_REFERER"]);
		}

		throw new CoreException;

	}

	public function deleteProductAction() {

		if($this->request->post["id"]) {
			
			ProductQuery::create()->findPK($this->request->post["id"])->delete();

			$this->response->redirect($_SERVER["HTTP_REFERER"]);
		}

		throw new CoreException;

	}

} 