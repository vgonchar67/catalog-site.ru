<?php

use gbook\core\ErrorHandler;

/**
 * Description of ApplicationTest
 *
 * @author Сергей
 */
class ErrorHandlerTest extends PHPUnit_Framework_TestCase {
	
	private $_errorHandler;
 
    protected function setUp() {
        $this->_errorHandler = new ErrorHandler();
    }
 
    protected function tearDown() {
        $this->_errorHandler = null;
    }
 
    public function testGetError() {
		$this->_errorHandler->addError('error', 'Текст ошибки');
        $result = $this->_errorHandler->getErrors();
        $this->assertEquals(['error'=> 'Текст ошибки'], $result);
    }
}
