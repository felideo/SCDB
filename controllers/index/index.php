<?php
namespace Controllers;

use Libs;

class Index extends \Libs\Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		header('location: ' . URL . 'login');
		$this->view->clean_render('index');
	}
}