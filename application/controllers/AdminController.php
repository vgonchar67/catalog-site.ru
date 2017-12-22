<?php
namespace App\controllers;

use App\core\Controller;
use Propel\Category;
use Propel\CategoryQuery;
use Propel\Product;
use Propel\ProductQuery;
use App\core\Pagenation;
use App\Exceptions\CoreException;
use App\Core\Session;

class adminController  extends Controller {

	const COUNT_ON_PAGE = 10;
	const DEFAULT_LAYOUT = 'admin';

	function indexAction () {
		$this->view->set([
			'title' => "Панель управления",
			'breadcrumbs' => [['Панель управления']]
		]);
	}

	function categoriesAction () {
		
		if($this->request->post) {
			if($this->request->post["cancel"]) {
				unset($_SESSION['category_filter']);
			} else {
				$_SESSION['category_filter'] = $this->request->post;
			} 
			$this->response->redirect($this->request->server["REDIRECT_URL"]);
		}
		$page = empty($this->request->get['page'])?1:$this->request->get['page'];
		$q = CategoryQuery::create()->setFilters(Session::get('category_filter'));
		$pagenation = new Pagenation($q->count(), self::COUNT_ON_PAGE, $page);
		$categories = $q->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE);

		$this->view->set([
			'title' => "Категории",
			'filter' => $_SESSION['category_filter'],
			'curUrlEncode' => urlencode($this->request->server['REQUEST_URI']),
			'categories' => $categories,
			'pagenationHTML' =>  $pagenation->getHtml(),
			'breadcrumbs' => [['Панель управления', '/admin'],['Категории']]
		]);
	}

	function productsAction () {

		if($this->request->post) {
			if($this->request->post["cancel"]) {
				unset($_SESSION['product_filter']);
			} else {
				$_SESSION['product_filter'] = array_filter($this->request->post, 'strlen');
			} 
			$this->response->redirect($this->request->server["REDIRECT_URL"]);
		}

		$q = ProductQuery::create()->setFilters($_SESSION['product_filter']);
		$pagenation = new Pagenation($q->count(), self::COUNT_ON_PAGE, $this->request->get['page']);
		$products = $q->paginate($pagenation->getCurrentPage(), self::COUNT_ON_PAGE);

		$this->view->set([
			'title' => "Товары",
			'categories' => CategoryQuery::getNamesArray(),
			'filter' => $_SESSION['product_filter'],
			'curUrlEncode' => urlencode($this->request->server['REQUEST_URI']),
			'products' => $products,
			'pagenationHTML' =>  $pagenation->getHtml(),
			'breadcrumbs' => [['Панель управления', '/admin'],['Товары']]
		]);
	}

	function editCategoryAction ($id) {
		$ref = $this->request->get["ref"] OR $ref = '/admin/categories';

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
		$title = $id ? "Редактирование категории" : "Новая категория";
		$this->view->set([
			'title' => $title,
			'ref' => $ref,
			'errors' => $category->getErrors(),
			'category' => $category,
			'breadcrumbs' => [['Панель управления', '/admin'],['Категории', '/admin/categories'],[$title]]
		]);
	}

	function editProductAction ($id) {
		$ref = $this->request->get["ref"] OR $ref = '/admin/products';

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
		$title = $id ? "Редактирование товара" : "Новый товар";
		$this->view->set([
			'title' => $title,
			'ref' => $ref,
			'errors' => $product->getErrors(),
			'product' => $product,
			'selectedCategories' => $product->getCategories()->toArray('Id'),
			'categories' => CategoryQuery::getNamesArray(),
			'breadcrumbs' => [['Панель управления', '/admin'],['Товары', '/admin/products'],[$title]]
		]);
	}

	public function deleteCategoryAction() {

		if($this->request->post["id"]) {

			CategoryQuery::create()->findPK($this->request->post["id"])->delete();

			$this->response->redirect($this->request->server["HTTP_REFERER"]);
		}

		throw new CoreException;

	}

	public function deleteProductAction() {

		if($this->request->post["id"]) {
			
			ProductQuery::create()->findPK($this->request->post["id"])->delete();

			$this->response->redirect($this->request->server["HTTP_REFERER"]);
		}

		throw new CoreException;

	}

} 