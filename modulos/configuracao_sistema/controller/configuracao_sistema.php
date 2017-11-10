<?php
namespace Controllers;

use Libs;

class Configuracao_Sistema extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'configuracao_sistema',
		'name'		=> 'Configurações de Sistema',
		'send'		=> 'Configurações de Sistema'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->modulo_list = $this->model->load_active_list($this->modulo['modulo']);
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->view->cadastro = $this->model->full_load_by_id('modulo', $id[0])[0];
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$insert_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->create('modulo', $insert_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'modulo');
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$update_db = carregar_variavel('modulo');
		$retorno = $this->model->update('modulo', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'modulo');
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");
		$retorno = $this->model->delete('modulo', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'modulo');
	}
}