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
		if(empty($dados_linha)){
			return false;
		}

		foreach ($dados_linha as $indice => $linha) {


			$data_inicio = $linha['bateria_data_inicio'];
			$data_fim    = $linha['bateria_data_fim'];

			$date_data_inicio = \DateTime::createFromFormat('Y-m-d', $data_inicio);
			$date_data_fim    = \DateTime::createFromFormat('Y-m-d', $data_fim);

			$date_hoje = new \DateTime();

			if($date_data_inicio > $date_hoje || $date_data_fim < $date_hoje && $_SESSION['usuario']['hierarquia'] == 3){
				continue;
			}

			if($_SESSION['usuario']['super_admin'] != 1 && $_SESSION['usuario']['hierarquia'] == 3 && $_SESSION['usuario']['id'] != $linha['id_usuario']){

				continue;
			}

			// debug2($linha);
			// exit;

			$url = URL;

			$botao_imprimir = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "imprimir") ?
				"<a href='{$url}{$this->modulo['modulo']}/imprimir/" . $linha['id_ficha_clinica'] . "' target='_blank' title='Imprimir'><i class='fa fa-print fa-fw'></i></a>" :
				'';

			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id_ficha_clinica']}</td>",
				"<td>{$linha['nome_paciente']}</td>",
				"<td>{$linha['nascimento_paciente']}</td>",
				"<td>{$linha['bateria_data_inicio']} a {$linha['bateria_data_fim']}</td>",
				"<td>{$linha['patologia_paciente']}</td>",
				"<td>{$linha['aluno_nome']}</td>",
	        	"<td>" . $this->view->default_buttons_listagem($linha['id_ficha_clinica'], true, true, false) . $botao_imprimir . "</td>"
			];
		}

		if(isset($retorno_linhas)){
			$this->view->linhas_datatable = $retorno_linhas;
		}
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro = $this->model->load_ficha_clinica($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro = $this->model->load_ficha_clinica($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');

		$this->view->lazy_view();
	}

	public function imprimir($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "imprimir");

		$this->view->cadastro = $this->model->load_ficha_clinica($id[0]);

		$this->view->master_gambi = "$(window).load(function(){\n\t\t"
			. "$('.navbar.navbar-default.navbar-static-top').hide();\n\t\t"
			. "$('#page-wrapper').css('width', '100%');\n\t\t"
			. "$('#page-wrapper').css('margin', '0px');\n\t\t"
			. "$('button').hide();\n\t\t"
			. "window.print();\n\t\t"
			. "window.onafterprint = function(){\n\t\t"
			. "window.top.close();\n\t\t"
			. "}\n\t\t"
			. "});\n";

		$this->view->render($this->modulo['modulo'] . '/editar/editar');
		$this->view->lazy_view();
	}




	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

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

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}


}



