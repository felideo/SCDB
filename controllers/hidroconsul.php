<?php
namespace Controllers;

use Libs;

class Hidroconsul extends \Libs\Controller {

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();


	}

	function index() {
		$this->view->hidrocontrol_list = $this->model->load_hidrocontrol_list();
		$this->view->hidroconsul_list = $this->model->load_hidroconsul_list();

		$this->view->render('hidroconsul');
	}

	public function create() {
		$hidroconsul = carregar_variavel('hidroconsul');
		$id_id_trecho = explode('+++', $hidroconsul['id_trecho']);

		$hidrometro_consumo = [
			'id_hidrocontrol' => $id_id_trecho[0],
			'id_trecho' => $id_id_trecho[1],
			'localizacao' => $hidroconsul['localizacao'],
			'ativo' => 1,
		];

		$this->model->create('hidroconsul', $hidrometro_consumo);

		header('location: ' . URL . 'hidroconsul');
	}

	public function delete($id) {
		$this->model->delete('hidroconsul', $id);
		header('location: ' . URL . 'hidroconsul');
	}


}