<?php
namespace Controllers;

use Libs;

/**
*
*/
class Login extends \Libs\Controller {
	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->view->clean_render('login');
	}

	function run() {
		$this->model->run();
	}
}