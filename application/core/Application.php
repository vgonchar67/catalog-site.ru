<?php
namespace App\core;

use App\exceptions\CoreException;
use App\Core\Registry;
use App\Core\Request;
use App\Core\Router;
use App\Core\Response;

/**
 * Основной класс приложения
 */
class Application {
	
	public function __construct(array $config) {
		$this->config = (object) $config;
		$this->request = new Request;
		$this->router = new Router($this->config->routes);
		$this->response = new Response;
		
	}
	
	/**
	 * Запускает приложение
	 *
	 * @return void
	 */
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
	
	/**
	 * Возвращает контроллер по имени, полученного из роутера
	 *
	 * @return Controller
	 */
	protected function loadController() {
		$controllerClassName = 'App\\controllers\\'. $this->router->getControllerName() . 'Controller';
		if(!class_exists($controllerClassName)) {
			throw new CoreException;
		}
		return new $controllerClassName($this);
	}
	
}