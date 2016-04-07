<?php
namespace Controllers;

use Libs;

class Trecho extends \Libs\Controller {

	public function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();
	}

	public function index() {
		$this->view->trechos_list = $this->model->load_active_list('trecho');
		$this->view->render('trecho');
	}

	public function create() {
		$trecho = carregar_variavel('trecho');
		$trecho['ativo'] = 1;
		$this->model->create('trecho', $trecho);
		header('location: ' . URL . 'trecho');
	}

	public function delete($id) {
		$this->model->delete($id);
		header('location: ' . URL . 'trecho');
	}
}