<?php
namespace Controllers;

use Libs;

class Painel_Controle extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'painel_controle',
		'name'		=> 'Painel de Controle',
		'send'		=> 'Painel de Controle'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;


		// $this->view->js = array('/dashboard/js/default.js');
	}

	function index() {
		$this->view->render($this->modulo['modulo'] . '/' . $this->modulo['modulo']);
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

	function cu(){

    $lerolero = $mpdf = new \vendor\Mpdf\Mpdf();

    debug2($lerolero);
    exit;
	}



}