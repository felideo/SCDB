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


		$this->view->listagem_pacientes = $this->model->load_pacientes_list(1);
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {

		$this->view->cadastro = $this->model->load_paciente($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function update($id) {
		$update_db = carregar_variavel($this->modulo['modulo']);

		$update_db += [
			"tipo" => 1
		];


		$retorno_paciente = $this->model->update('paciente', $id[0], $update_db);

		$update_endereco = carregar_variavel('endereco');
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

	public function transformar_ex_paciente($id){

		$update_db = [
			"tipo" => 2
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração de paciente para ex paciente efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao transformar o paciente em ex paciente, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function transformar_candidato($id){

		$update_db = [
			"tipo" => 0
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração de paciente para ex paciente efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao transformar o paciente em candidato, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}
}