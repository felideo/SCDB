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

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Email', 'Hierarquia', 'Ações']);
		$this->listagem($this->model->load_active_list($this->modulo['modulo']));

		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function listagem($dados_linha){
		foreach ($dados_linha as $indice => $linha) {
			if($linha['super_admin'] != 1){
				$retorno_linhas[] = [
					"<td class='sorting_1'>{$linha['id']}</td>",
	        		"<td>{$linha['email']}</td>",
	        		"<td>{$linha['hierarquia']}</td>",
	        		"<td>" . $this->view->default_buttons_listagem($linha['id']) . "</td>"
				];
			}
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");
		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
		$this->view->lazy_view();
	}

	public function create(){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$insert_db = carregar_variavel('usuario');

		$insert_db += [
			"senha" => \Util\Hash::get_unic_hash()
		];

		$retorno = $this->model->create('usuario', $insert_db);


		if($retorno['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'usuario');
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

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
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		$retorno = $this->model->delete('usuario', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'usuario');
	}

	public function verificar_duplicidade_ajax(){
		$email = carregar_variavel('usuario');

		echo json_encode(empty($this->model->load_user_by_email($email)));
		exit;
	}
}