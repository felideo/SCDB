<?php
namespace Controllers;
use Libs;

class Error extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'error',
		'name'		=> 'Error',
		'send'		=> 'Errors'
	];

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->view->msg = 'Esta página não existe';
		$this->view->render($this->modulo['modulo'] . '/' . $this->modulo['modulo']);
	}
}