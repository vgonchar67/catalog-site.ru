<?php
namespace gbook\controllers;

use gbook\core\Controller;
use gbook\core\Pagenation;
use gbook\models\Comment;

class IndexController  extends Controller {

	const COUNT_ON_PAGE = 3;

	function indexAction () {

		$count = Comment::getCount();
		$pagenation = new Pagenation($count, self::COUNT_ON_PAGE, $this->request->get['page']);

		$this->view->set(['comments' => [
			'count'=> $count,
			'items' => Comment::getList($pagenation->getCurrentPage(), self::COUNT_ON_PAGE),
			'pagenationHTML' =>  $pagenation->getHtml()
		]]);
	}

	function addActionAjax () {
		
		$response = [];
		
		$values = [
			'user_name' => $this->request->post['user_name'],
			'email' => $this->request->post['email'],
			'text' => $this->request->post['text'],
			'homepage' => $this->request->post['homepage'],
		];

		Captcha::check($this->request->post['captcha'], $this->errorHandler);
		
		$comment = new Comment();
		$response['result'] = $comment->add($values, $this->errorHandler);
		$response['errors'] = $this->errorHandler->getErrors();
		
		if ($response['result']) {
			$response['redirect'] = '/?page=' . ceil(Comment::getCount()/self::COUNT_ON_PAGE);
		}
		
		$this->outJSON($responce);
		
	}

} 