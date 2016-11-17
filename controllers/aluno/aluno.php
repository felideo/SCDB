<?php
namespace Controllers;

use Libs;

class Aluno extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'aluno',
		'name'		=> 'Alunos',
		'send'		=> 'Aluno'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");


		$this->view->set_colunas_datatable(['Nome', 'Curso', 'Semestre', 'Turma', 'RGM', 'Ações']);
		$this->listagem($this->model->load_active_list($this->modulo['modulo']));

		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function listagem($dados_linha){
		if(empty($dados_linha)){
			return false;
		}
		foreach ($dados_linha as $indice => $linha) {
			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id']}</td>",
				"<td>{$linha['nome']}</td>",
				"<td>{$linha['curso']}</td>",
				"<td>{$linha['semestre']}</td>",
				"<td>{$linha['turma']}</td>",
				"<td>{$linha['rgm']}</td>",
	        	"<td>" . $this->view->default_buttons_listagem($linha['id']) . "</td>"
			];
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->view->cadastro = $this->model->load_aluno($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->cadastro = $this->model->load_aluno($id[0]);

		$this->view->render($this->modulo['modulo'] . '/editar/editar');

		$this->view->lazy_view();
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");


		$insert_db = carregar_variavel($this->modulo['modulo']);
		$insert_contato = carregar_variavel('contato');

		$insert_usuario = [
			'email' 	 => $insert_contato[2],
			'senha' 	 => md5($insert_contato[2]),
			'hierarquia' => 2
		];

		$retorno_usuario = $this->model->create('usuario', $insert_usuario);


		if(isset($retorno_usuario['id']) && $retorno_usuario['status'] == 1){
			$insert_db += [
				'id_usuario' => $retorno_usuario['id']
			];

			$retorno = $this->model->create($this->modulo['modulo'], $insert_db);
		}

		if(isset($retorno['id']) && $retorno['status'] == 1){
			foreach ($insert_contato as $indice => $contato) {
				$contato = [
					'contato'		=> $contato,
					'id_aluno' 		=> $retorno['id'],
					'tipo' 			=> $indice
				];

				$retorno_contato[] = $this->model->create('contato', $contato);
				unset($insert_contato);
			}
		}

		if($retorno_usuario['status'] && $retorno['status'] && $retorno_contato[0]['status'] ){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");


		$update_db = carregar_variavel($this->modulo['modulo']);
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


		$retorno_usuario = $this->model->delete('usuario', $id[1]);

		if($retorno_usuario['status']){
			$retorno_aluno = $this->model->delete_relacao('aluno', 'id', $id[0]);
			$retorno_contato = $this->model->delete_relacao('contato', 'id_aluno', $id[0]);
		}

		if($retorno_usuario['status'] && $retorno_aluno['status'] && $retorno_contato['status'] ){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}
}