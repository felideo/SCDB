<?php
namespace Controllers;

use Libs;

class Modulo extends \Libs\Controller {

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();


	}

	function index() {
		$this->view->modulo_list = $this->model->load_full_list('modulos');
		$this->view->render('modulo');
	}

	public function create() {
		$modulo = carregar_variavel('modulo');
		$this->model->create('modulos', $modulo);
		header('location: ' . URL . 'modulo');
	}

	public function delete($id) {
		$this->model->delete($id);
		header('location: ' . URL . 'modulo');

	}


}