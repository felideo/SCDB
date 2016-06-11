<?php
namespace Controllers;

use Libs;

/**
*
*/
class Painel_Controle extends \Libs\Controller {
	function __construct($twig) {

		$this->set_cu($twig);


		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->js = array('/dashboard/js/default.js');
	}

	function index() {
		// debug2($this->cu);
		// $this->view->render('painel_controle');

		// $twig = new Twig_Enviroment($loader, ['cache' => 'twig_cache']);

		echo $this->cu->render('painel_controle/painel_controle.html', array('cu' => 'Fabien'));
	}

	function logout() {
		\Libs\Session::destroy();
		header('location: '. URL .'login');
		exit;
	}

	function xhrInsert() {
		$this->model->xhrInsert();
	}

	function xhrGetListings() {
		$this->model->xhrGetListings();
	}

	function xhrDeleteListing() {
		$this->model->xhrDeleteListing();
	}



}