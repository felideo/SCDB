<?php
namespace Controllers;

use Libs;

class Ex_Paciente extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'ex_paciente',
		'name'		=> 'Ex Pacientes',
		'send'		=> 'Ex paciente'
	];

	function __construct() {

		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {

		$this->view->listagem_ex_pacientes = $this->load_external_model('paciente')->load_pacientes_list(2);
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
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

	public function transformar_paciente($id){

		$update_db = [
			"tipo" => 1
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração de ex paciente para paciente efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao transformar o ex paciente em paciente, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function transformar_candidato($id){

		$update_db = [
			"tipo" => 0
		];

		$retorno = $this->model->update('paciente', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração de ex paciente para candidato efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao transformar o ex paciente em candidato, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}
}