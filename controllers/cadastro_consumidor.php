<?php
namespace Controllers;

use Libs;
/**
*
*/
class Cadastro_Consumidor extends \Libs\Controller {

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->js = array('/dashboard/js/default.js');
	}

	function index() {
		$this->view->render('cadastro_consumidor');
	}

	function logout() {
		\Libs\Session::destroy();
		header('location: '. URL .'login');
		exit;
	}

	function cadastrar_consumidor(){
		$consumidor = carregar_variavel('consumidor_cadastro');
		$this->model->create('consumidor_cadastro', $consumidor);
		header('location: ' . URL . 'cadastro_consumidor');
		exit;
	}
}