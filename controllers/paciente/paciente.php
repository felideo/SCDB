<?php
namespace Controllers;

use Libs;

class Paciente extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'paciente',
		'name'		=> 'Pacientes',
		'send'		=> 'Paciente'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Nome', 'Idade', 'Sexo', 'Patologia', 'Ações']);
		$this->listagem($this->model->load_pacientes_list(1));

		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function listagem($dados_linha){
		if(empty($dados_linha)){
			return;
		}

		foreach ($dados_linha as $indice => $linha) {
			$nascimento = new \DateTime($linha['nascimento']);
	        $hoje = new \DateTime(date('Y-m-d'));
	        $diferenca = $nascimento->diff($hoje);

	        // $idade = $diferenca->y . ' anos e ' . $diferenca->m . ' meses';
	        $idade = $diferenca->y . ' anos';

			$sexo = $linha['sexo'] == 1 ? "Masculino" : "Feminino";

			$botao_paciente = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_transformar_paciente") ?
				"<a href='#' class='transformar_paciente' data-id-paciente='{$linha['id']}' title='Transformar em Paciente'><i class='fa fa-check-circle fa-fw'></i></a>" :
				'';
    		$botao_ex_paciente = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_transformar_ex_paciente") ?
    			"<a href='#' class='transformar_ex_paciente' data-id-paciente='{$linha['id']}' title='Transformar em EX Paciente'><i class='fa fa-times-circle fa-fw'></i></a>" :
    			'';

    		$botao_candidato = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_transformar_candidato") ?
    			"<a href='#' class='transformar_candidato' data-id-paciente='{$linha['id']}' title='Transformar em Candidato'><i class='fa fa-question-circle fa-fw'></i></i></a>" :
    			'';

			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id']}</td>",
				"<td>{$linha['nome']}</td>",
				"<td>{$idade}</td>",
				"<td>{$sexo}</td>",
				"<td>{$linha['patologia']}</td>",
	        	"<td>" . $this->view->default_buttons_listagem($linha['id'], true, true, false) . $botao_candidato . $botao_ex_paciente . "</td>"
			];
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro = $this->model->load_paciente($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}


		$this->view->cadastro = $this->model->load_paciente($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');

		$this->view->lazy_view();
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$insert_db = carregar_variavel($this->modulo['modulo']);

		$insert_db += [
			"tipo" => 0
		];

		$retorno_paciente = $this->model->create('paciente', $insert_db);

		if(isset($retorno_paciente['id']) && $retorno_paciente['status'] == 1){
			$insert_endereco = carregar_variavel('endereco');

			$insert_endereco += [
				'id_paciente' => $retorno_paciente['id']
			];

			$insert_endereco['cep'] = str_replace('-', '', $insert_endereco['cep']);


			$insert_endereco['cep'] = str_replace('-', '', $insert_endereco['cep']);
			$retorno_endereco = $this->model->create('endereco', $insert_endereco);
		}

		if(isset($retorno_paciente['id']) && $retorno_paciente['status'] == 1){
			foreach (carregar_variavel('contato') as $indice => $contato) {
				$insert_contato = [
					'contato'		=> $contato,
					'id_paciente' 	=> $retorno_paciente['id'],
					'tipo' 			=> $indice
				];

				$retorno_contato[] = $this->model->create('contato', $insert_contato);
				unset($insert_contato);
			}
		}

		if($retorno_paciente['status'] && $retorno_endereco['status'] && $retorno_contato[0]['status'] ){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}


		$update_db = carregar_variavel($this->modulo['modulo']);

		$update_db += [
			"tipo" => 1
		];

		$retorno_paciente = $this->model->update('paciente', $id[0], $update_db);

		$update_endereco = carregar_variavel('endereco');

		$update_endereco['cep'] = str_replace('-', '', $update_endereco['cep']);

		$retorno_endereco = $this->model->update_relacao('endereco', 'id_paciente', $id[0], $update_endereco);

		foreach (carregar_variavel('contato') as $indice => $contato) {
			$insert_contato = [
				'contato' => $contato
			];

			$retorno_contato[] = $this->model->update_relacao('contato', 'tipo` = ' . $indice . ' AND `id_paciente', $id[0], $insert_contato);
		}

		if($retorno_paciente['status'] && $retorno_endereco['status'] && $retorno_contato[0]['status']){
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

		$retorno_paciente = $this->model->delete('paciente', $id[0]);

		if($retorno_paciente['status']){
			$retorno_contato = $this->model->delete_relacao('contato', 'id_paciente', $id[0]);
			$retorno_endereco = $this->model->delete_relacao('endereco', 'id_paciente', $id[0]);
		}

		if($retorno_paciente['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function transformar_paciente($id){

		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "transformar_paciente");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$update_db = [
			"tipo" => 1
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a alteração, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function transformar_ex_paciente($id){

		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "transformar_ex_paciente");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$update_db = [
			"tipo" => 2
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a alteração, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function transformar_candidato($id){

		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "transformar_candidato");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$update_db = [
			"tipo" => 0
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a alteração, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}
}