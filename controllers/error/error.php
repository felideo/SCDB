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
		// $this->view->alert_js('A pagina que você tentou acessar não existe!!!', 'erro');
		header('location: /');
	}
}