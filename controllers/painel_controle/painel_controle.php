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

		$this->view->bateria_atual = $this->model->carregar_bateria();

		$retorno_chamada = [];

		foreach ($chamadas as $indice => $chamada) {
			if(!empty($chamada['id_aluno']) && !empty($chamada['id_paciente'])){
				if(empty($chamada['presenca_aluno'])){
					$retorno_chamada['aluno'][] = $chamada;
				}

				if(empty($chamada['presenca_paciente'])){
					$retorno_chamada['paciente'][] = $chamada;
				}
			}elseif(!empty($chamada['id_paciente']) && empty($chamada['id_aluno'])){
				if(empty($chamada['presenca_paciente'])){
					$retorno_chamada['paciente'][] = $chamada;
				}
			}elseif(!empty($chamada['id_aluno']) && empty($chamada['id_paciente'])){
				if(empty($chamada['presenca_aluno'])){
					$retorno_chamada['aluno'][] = $chamada;
				}
			}

		}

		$this->view->faltas = $this->model->carregar_faltas();
		$this->view->justificativas = json_encode($this->model->carregar_faltas());


		$this->view->chamada = !empty($retorno_chamada) ? $retorno_chamada : NULL;

		$this->view->render($this->modulo['modulo'] . '/' . $this->modulo['modulo']);
	}

	public function faltou_de_mais($dados){

		if($dados[2] == 'pacientes'){
			\Util\Permission::check_user_permission('paciente', 'paciente_remover_por_excesso_de_faltas');

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
			\Util\Permission::check_user_permission('aluno', 'aluno_remover_por_excesso_de_faltas');
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

	public function justificar_falta($dados){
		if($dados[2] == 'pacientes'){
			$faltas = $this->model->carregar_faltas_paciente($dados[1]);
			$this->view->tipo = "paciente";
		}elseif($dados[2] == 'alunos'){
			$faltas = $this->model->carregar_faltas_aluno($dados[1]);
			$this->view->tipo = "aluno";
		}

		$this->view->faltas = $faltas;
		$this->view->clean_render('/justificar/justificar');

	}

	public function justificar(){
		$tipo = carregar_variavel('tipo');
		$justificar = carregar_variavel('justificar');

		if($tipo == 'paciente'){
			$retorno = $this->model->update('agendamento', $justificar['id'], ['justificativa_paciente' => $justificar['justificativa_paciente']]);

			if($retorno['status']){
				$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
			} else {
				$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
			}

		}elseif($tipo == 'aluno'){
			$retorno = $this->model->update('agendamento', $justificar['id'], ['justificativa_aluno' => $justificar['justificativa_aluno']]);

			if($retorno['status']){
				$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
			} else {
				$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
			}

		}

		header('location: ' . URL . 'painel_controle');
	}

}