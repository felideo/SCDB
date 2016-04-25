<?php
namespace Controllers;

use Libs;

class Hidrocontrol extends \Libs\Controller {

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();


	}

	function index() {
		$this->view->trecho_list = $this->model->load_trecho_free_list('id_trecho');
		$this->view->anterior_trecho_list = $this->model->load_trecho_free_list('trecho_anterior');
		$this->view->hidrocontrol_list = $this->model->load_hidrocontrol_list();
		$this->view->render('hidrocontrol');
	}

	public function create() {
		$hidrocontrol = carregar_variavel('hidrocontrol');
		$this->model->create('hidrocontrol', $hidrocontrol);
		header('location: ' . URL . 'hidrocontrol');
	}

	// public function delete($id) {
	// 	$this->model->delete($id);
	// 	header('location: ' . URL . 'modulo');


	// }
}