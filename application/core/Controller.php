<?php
namespace App\core;

use App\exceptions\CoreException;

/**
 * Абстрактный класс контроллера
 */
abstract class Controller {
	public $application;
	const DEFAULT_LAYOUT = "default";
	
	function __construct(Application $application) {
		$this->application = $application;
		$this->view = new View;
		$this->view->setPath('/' . $this->router->getControllerName() . '/');
		$this->view->setLayout($this::DEFAULT_LAYOUT);
	}
	
	/**
	 * Вызывает Action контроллера и устанавливает контент в response
	 *
	 * @return void
	 */
	function run() {
		
		$action = $this->router->getActionName() . "Action";
		if (!method_exists($this, $action)) {
			throw new CoreException;
		}
		
		ob_start();
		call_user_func_array(array($this, $action), $this->router->getActionParams());
		$this->view->render($this->router->getActionName());
		$this->response->setContent(ob_get_contents());
		ob_clean();
	}
	
	public function __get($name) 
    {
        if (property_exists($this->application, $name)) {
            return $this->application->$name;
        }        
    }
	
}
