<?php
namespace Controllers;

use Libs;

class Master extends \Libs\Controller {

	function __construct() {
		parent::__construct();
	}

	function index(){

	}

	function logout() {
		\Libs\Session::destroy();
		header('location: '. URL .'login');
		exit;
	}
}