<?php
namespace Controllers;

use Libs;

class Login extends \Libs\Controller {
	function __construct() {
		\Util\Auth::handLeLoggin();
		parent::__construct();
	}

	function index() {
		$this->view->clean_render('/login/login');
	}

	function run() {
		$this->model->run();
	}
}