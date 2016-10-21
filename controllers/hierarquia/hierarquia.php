<?php
namespace Controllers;

use Libs;

class Hierarquia extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'hierarquia',
		'name'		=> 'Hierarquias',
		'send'		=> 'Hierarquia'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->hierarquia_list = $this->model->load_active_list($this->modulo['modulo']);
		$this->view->permissoes_list = $this->load_external_model('permissao')->load_permissions_list();
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {
		$this->view->cadastro = $this->model->full_load_by_id($this->modulo['modulo'], $id[0])[0];
		$this->view->permissoes_list = $this->load_external_model('permissao')->load_permissions_list();
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function create() {
		$insert_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->create($this->modulo['modulo'], $insert_db);

		if($retorno['status'] && $retorno_permissoes[count($retorno_permissoes)]['erros'] == 0){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function update($id) {
		$update_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);


		if($retorno['status']){
			$retorno = $this->model->update_relacao('hierarquia_relaciona_permissao', 'id_hierarquia', $id[0], ['ativo' => 0]);
			foreach (carregar_variavel('hierarquia_relaciona_permissao') as $indice => $permissao) {
				$insert_permissao = [
					'id_hierarquia' => $id[0],
					'id_permissao' => $permissao
				];
			}
		}

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function delete($id) {
		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}
}