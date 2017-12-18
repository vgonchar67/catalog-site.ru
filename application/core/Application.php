<?php
namespace app\core;

use app\exceptions\CoreException;
class Application {
	
	public function __construct($config) {
		$this->config = new Registry($config);
		$this->request = new Request;
		$this->router = new Router($this->config->routes);
		$this->response = new Response;
		
		$this->setParams();
	}
	
	public function run() {
		try {
			$controller = $this->loadController();
			$controller->run();
		} catch (CoreException $e){
			$this->router->error404();
			$this->loadController()->run();
		}
		$this->response->sendHeaders();
		echo $this->response->getContent();
	}
	
	protected function loadController() {
		$controllerClassName = 'app\\controllers\\'. $this->router->getControllerName() . 'Controller';
		if(!class_exists($controllerClassName)) {
			throw new CoreException;
		}
		return new $controllerClassName($this);
	}
	
	
	protected function setParams()
    {
        define('DB_HOST', $this->config->db['host']);
        define('DB_NAME', $this->config->db['name']);
        define('DB_USER', $this->config->db['user']);
        define('DB_PASSWORD', $this->config->db['password']);
    }
}