<?php
namespace Controllers;

use Libs;

class Consumidor extends \Libs\Controller {

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();
	}

	function index() {
		$this->view->ap_list = $this->model->load_ap_list();
		$this->view->consumidor_list = $this->model->load_consumidor_list('consumidor');
		$this->view->render('consumidor');
	}

	public function create() {
		$consumidor = carregar_variavel('consumidor');
		$id_id_trecho = explode('+++', $consumidor['id_hidroconsul']);

		$consumidor = [
			'nome' => $consumidor['nome'],
			'email' => $consumidor['email'],
			'telefone' => $consumidor['telefone'],
			'id_hidroconsul' => $id_id_trecho[0],
			'id_trecho' => $id_id_trecho[1],
			'ativo' => 1
		];

		$this->model->create('consumidor', $consumidor);
		header('location: ' . URL . 'consumidor');
	}



	// public function delete($id) {
	// 	$this->model->delete($id);
	// 	header('location: ' . URL . 'modulo');

	// }
}