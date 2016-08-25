<?php
namespace Controllers;

use Libs;

class Usuario extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'usuario',
		'name'		=> 'Usuários',
		'send'		=> 'Usuário'
	];


	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->listagem_usuarios = $this->model->load_active_list($this->modulo['modulo']);
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {
		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function create(){
		$insert_db = carregar_variavel('usuario');
		$retorno = $this->model->create('usuario', $insert_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'usuario');
	}

	public function update($id) {
		$update_db = carregar_variavel('usuario');

		if(empty($update_db['senha'])){
			unset($update_db['senha']);
		}

		$retorno = $this->model->update('usuario', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'usuario');
	}

	public function delete($id) {
		$retorno = $this->model->delete('usuario', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'usuario');
	}
}