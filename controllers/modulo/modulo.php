<?php
namespace Controllers;

use Libs;

class Modulo extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'modulo',
		'name'		=> 'Módulos',
		'send'		=> 'Módulo'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->modulo_list = $this->model->load_modulo_list($this->modulo['modulo']);
		$this->view->submenu_list = $this->model->load_active_list('submenu');
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->view->cadastro = $this->model->full_load_by_id('modulo', $id[0])[0];
		$this->view->submenu_list = $this->model->load_active_list('submenu');
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");
		$insert_db = carregar_variavel($this->modulo['modulo']);

		if(empty($insert_db['id_submenu'])){
			$insert_db['id_submenu'] = NULL;
		}

		$retorno = $this->model->create($this->modulo['modulo'], $insert_db);

		if($retorno['status']){
			$retorno_permissoes = $this->model->permissoes_basicas($insert_db['modulo'], $retorno['id']);
		}

		if($retorno['status'] && $retorno_permissoes[count($retorno_permissoes)]['erros'] == 0){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");
		$update_db = carregar_variavel($this->modulo['modulo']);

		if(empty($update_db['id_submenu'])){
			$update_db['id_submenu'] = NULL;
		}

		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}
}



