<?php
namespace Controllers;

use Libs;

/**
*
*/
class Painel_Controle extends \Libs\Controller {
	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->js = array('/dashboard/js/default.js');
	}

	function index() {
		$this->view->render('painel_controle');
	}

	function logout() {
		\Libs\Session::destroy();
		header('location: '. URL .'login');
		exit;
	}

	function xhrInsert() {
		echo 'lerolero';
		$this->model->xhrInsert();
	}

	function xhrGetListings() {
		$this->model->xhrGetListings();
	}

	function xhrDeleteListing() {
		$this->model->xhrDeleteListing();
	}

}