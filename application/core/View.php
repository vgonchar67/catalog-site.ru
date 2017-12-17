<?php
namespace gbook\core;

use \gbook\exceptions\CoreException;

class View {
	
	public $data = [];
	
	public $templateLayuot = 'default';
	
	private $viewsRoot = '../application/views';
	
	private $path = '/';
	
	
	protected $templateExtention = '.php';
	
	
	public function __construct() {

	}
	
	function setLayout($layout) {
		$this->templateLayuot = $layout;
		return $this;
	}
	
	function set(array $arr) {
		foreach ($arr as $key => $value) {
			$this->data[$key] = $value;
		}
		return $this;
	}
	
	public function setPath($path) {
		$this->path = $path;
	}
	
	public function parse ($template) {
		if($template{0} == '/') {
			$templateFile = $this->viewsRoot . $template . $this->templateExtention;
		} else {
			$templateFile = $this->viewsRoot . $this->path . $template . $this->templateExtention;
		}
		if (!file_exists($templateFile)) {
			throw new CoreException;
		}
		ob_start();
		extract($this->data, EXTR_SKIP);
		include($templateFile);		
		return ob_get_clean();
	}
	
	public function render($template) {

		$this->set([
			'content' => $this->parse($template)
		]);
		
		echo $this->parse('/layouts/' . $this->templateLayuot);
	}
}