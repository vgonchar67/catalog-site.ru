<?php
namespace App\core;

use App\exceptions\CoreException;

class Controller {
	public $application;
	
	function __construct(Application $application) {
		$this->application = $application;
		$this->errorHandler = new ErrorHandler;
		$this->view = new View;
		$this->view->setPath('/' . $this->router->getControllerName() . '/');
		$this->view->setLayout('default');
	}
	
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
