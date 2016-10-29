<?php
namespace Controllers;

use Libs;

class Ficha_Clinica extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'ficha_clinica',
		'name'		=> 'Fichas Clinicas',
		'send'		=> 'Ficha Clinica'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Paciente', 'Idade', 'Atendimento', 'Patologia', 'Estagiario', 'Ações']);
		$this->listagem($this->model->load_ficha_clinica_list());

		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function listagem($dados_linha){
		foreach ($dados_linha as $indice => $linha) {
			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id_ficha_clinica']}</td>",
				"<td>{$linha['nome_paciente']}</td>",
				"<td>{$linha['nascimento_paciente']}</td>",
				"<td>{$linha['bateria_data_inicio']} a {$linha['bateria_data_fim']}</td>",
				"<td>{$linha['patologia_paciente']}</td>",
				"<td>{$linha['aluno_nome']}</td>",
	        	"<td>" . $this->view->default_buttons_listagem($linha['id_ficha_clinica']) . "</td>"
			];
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->view->cadastro = $this->model->load_ficha_clinica($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->cadastro = $this->model->load_ficha_clinica($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');

		$this->view->lazy_view();
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
}



