<?php
namespace Controllers;

use Libs;

class Hidrocontrol extends \Libs\Controller {

	public function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();
	}

	public function index() {
		$this->view->hidrometro_controle_list = $this->model->hidrometro_controle_list();
		$this->view->render('hidrocontrol');
	}

	public function create() {
		$trecho = carregar_variavel('trecho');
		$trecho['ativo'] = 1;
		$this->model->create($trecho);
		header('location: ' . URL . 'trecho');
	}

	public function delete($id) {
		debug2($id);
		// exit;
		$this->model->delete($id);
		header('location: ' . URL . 'trecho');

	}
}