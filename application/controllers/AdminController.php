<?php
namespace gbook\controllers;

use gbook\core\Controller;
use gbook\core\Request;
use gbook\models\Comment;
use gbook\models\Auth;
use gbook\core\Pagenation;
use gbook\core\Response;
use \gbook\exceptions\CoreException;


class AdminController  extends Controller {

	const COUNT_ON_PAGE = 3;
	
	public function afterConstruct() {
		$this->view->setLayout('admin');
	}

	function indexAction () {
		$this->checkPermission();
		
		$pagenation = new Pagenation(Comment::getCount(), self::COUNT_ON_PAGE, $this->request->get['page'], '/admin');
		
		$this->view->set([
			'comments' => Comment::getList($pagenation->getCurrentPage(), self::COUNT_ON_PAGE),
			'pagenationHTML' => $pagenation->getHtml()
		]);
		
	}
	
	function editAction ($id) {
		$this->checkPermission();
		
		if(!empty($this->request->post['submit'])) {
			$comment = new Comment();
			$result = $comment->update($id, $this->request->post, $this->errorHandler);
			if($result) {
				Response::redirect('/admin?page='.Comment::getPageById($id, self::COUNT_ON_PAGE));
			} else {
				$arrComment = $this->request->post;
				$arrComment['id'] = $id;
			}
			
		} else {
			$arrComment = Comment::getById($id);
		}
		
		$this->view->set([
			'comment' => $arrComment,
			'errors' => $this->errorHandler->getErrors()
		]);
	}
	
	function deleteAction () {

		if(empty($this->request->post['submit']) || empty($this->request->post['id'])) {
			throw new CoreException;
		}
		if(Auth::isAdmin()) {
			$id = (int)$this->request->post['id'];
			Comment::delete($id);
		}

		Response::redirect($this->request->server['HTTP_REFERER']);
		
	}
	
	function authAction ($redirect = '/admin') {

		$result = false;
		$login  = $this->request->post['login'];
		$password = $this->request->post['password'];
		
		if(isset($this->request->post['submit'])) {
			$result = Auth::userAuth($login, $password, $this->errorHandler);
		}

		if($result) {
			$this->response->redirect($redirect);
		}
		
		$this->view->set([
			'errors'=> $this->errorHandler->getErrors(),
			'login' => $login,
			'password' => $password
		]);
		$this->view->render('auth');

	}
	
	function logOutAction () {
		Auth::logOut();
		Response::redirect($this->request->server['HTTP_REFERER']);
	}
	
	private function checkPermission () {
		if(!Auth::isAdmin()) {
			$this->authAction($_SERVER['REQUEST_URI']);
			die;
		}
	}
	
} 