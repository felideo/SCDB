<?php
namespace Controllers;

use Libs;

class Candidato extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'candidato',
		'name'		=> 'Candidatos',
		'send'		=> 'Candidato'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();

		$this->view->modulo = $this->modulo;
	}

	public function index() {

		$this->view->listagem_candidatos = $this->model->load_pacientes_list(0);
		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {

		$this->view->cadastro = $this->load_external_model('paciente')->load_paciente($id[0]);
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function create() {

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

		debug2($_POST);

		$update_db = carregar_variavel($this->modulo['modulo']);

		$update_db += [
			"tipo" => 0
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
}