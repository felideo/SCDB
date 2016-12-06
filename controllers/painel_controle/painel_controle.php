<?php
namespace Controllers;

use Libs;

class Painel_Controle extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'painel_controle',
		'name'		=> 'Painel de Controle',
		'send'		=> 'Painel de Controle'
	];

	public function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$chamadas = $this->model->carregar_chamada();

		foreach ($chamadas as $indice => $chamada) {
			if(empty($chamada['id_paciente']) && empty($chamada['id_aluno'])){
				unset($chamadas[$indice]);
			}
		}

		$this->view->faltas = $this->model->carregar_faltas();

		foreach ($chamadas as $indice => $chamada) {
			if(empty($chamada['agendamento_data'])){
				unset($chamadas[$indice]);
			}
		}


		$this->view->chamada = !empty($chamadas) ? $chamadas : NULL;

		$this->view->render($this->modulo['modulo'] . '/' . $this->modulo['modulo']);
	}

	public function faltou_de_mais($dados){
		// \Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		if($dados[2] == 'pacientes'){

			$update_db = [
				'tipo' => 2
			];

			$retorno = $this->model->update('paciente', $dados[1], $update_db);

			if($retorno['status']){
				$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
			} else {
				$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
			}

		}elseif($dados[2] == 'alunos'){
			$update_db = [
				'tipo' => 0
			];

			$retorno = $this->model->update('aluno', $dados[1], $update_db);

			if($retorno['status']){
				$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
			} else {
				$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
			}
		}


		header('location: ' . URL . 'painel_controle');
	}

}