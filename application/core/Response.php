<?php

namespace App\core;

class Response {
	
	protected $headers = [];
	protected $content;
	
	public function setHeader($value) {
        $this->headers[] = (string) $value;
    }
	
	public function sendHeaders() {
		foreach ($this->headers as $header) {
            header($header);
        }
	}
	
	public function setContent($content = '') {
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public static function redirect($url = '/') 
    {
        $responce = new self();
        $responce->setHeader('Location: ' . $url);
        $responce->sendHeaders();
		exit;
    }  
}