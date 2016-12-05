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
		$chamadas = $this->model->carregar_chamada();
		$this->view->faltas = $this->model->carregar_faltas();

		foreach ($chamadas as $indice => $chamada) {
			if(empty($chamada['agendamento_data'])){
				unset($chamadas[$indice]);
			}
		}


		$this->view->chamada = !empty($chamadas) ? $chamadas : NULL;

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


	function zzz(){
		echo \Util\Hash::get_unic_hash() . '<br>';
		echo \Util\Hash::get_unic_hash() . '<br>';
		echo \Util\Hash::get_unic_hash() . '<br>';
		echo \Util\Hash::get_unic_hash() . '<br>';
		echo \Util\Hash::get_unic_hash() . '<br>';
		echo \Util\Hash::get_unic_hash() . '<br>';
		exit;
	}


}