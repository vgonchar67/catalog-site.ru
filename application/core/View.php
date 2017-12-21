<?php
namespace App\core;

use \App\exceptions\CoreException;

class View {
	
	public $data = [];

	private $viewsRoot;
	
	private $path = '/';

	private $twig;

	private $loader;

	public $layout;
	
	
	protected $templateExtention = '.htm';
	
	
	public function __construct() {
		$this->viewsRoot = $_SERVER["DOCUMENT_ROOT"] . '/application/views';
		$this->loader = new \Twig_Loader_Filesystem($this->viewsRoot . '/');
		$this->twig = new \Twig_Environment($this->loader);
	}
	
	/**
	 * Undocumented function
	 *
	 * @param array $arr
	 * @return void
	 */
	function set(array $arr) {
		foreach ($arr as $key => $value) {
			$this->data[$key] = $value;
		}
		return $this;
	}

	function setLayout($layout) {
		$this->set(array("layout" => '/layouts/' . $layout . $this->templateExtention));
	}
	
	public function setPath($path) {
		$this->path = $path;
	}

	public function parse($template) {
		return $this->twig->render($this->path . $template . $this->templateExtention, $this->data);
	}
	
	public function render($template) {
		if(empty($this->data["layout"])) {
			$this->twig->display($this->path . $template . $this->templateExtention, $this->data);
		} else {
			$this->data["include_content"] = $this->path . $template . $this->templateExtention;
			$this->twig->display($this->data["layout"], $this->data);
		}
		
	}
}