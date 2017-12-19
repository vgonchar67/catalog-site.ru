<?php
namespace App\controllers;

use App\core\Controller;
use Propel\Category;
use Propel\CategoryQuery;
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
			
			if($category->save()) {
				$this->response->redirect('/admin/categories');
			}
		}
	
		$this->view->set(['category' => [
			'errors' => $category->getErrors(),
			'values' => $category->toArray()
		]]);
	}

} 