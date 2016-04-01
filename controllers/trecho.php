<?php
namespace Controllers;

use Libs;

class Trecho extends \Libs\Controller {

	public function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
	}

	public function index() {
		$this->view->trechos_list = $this->model->trecho_list();
		$this->view->render('trecho');
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