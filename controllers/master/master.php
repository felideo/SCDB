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

	function limpar_alertas_ajax(){
		unset($_SESSION['alertas']);
		echo json_encode("Alertas limpos");
		exit;
	}
}