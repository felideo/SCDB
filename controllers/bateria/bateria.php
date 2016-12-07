<?php
namespace Controllers;

use Libs;

class Bateria extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'bateria',
		'name'		=> 'Baterias',
		'send'		=> 'Bateria'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->bateria_list = $this->model->load_active_list($this->modulo['modulo']);

		$date_time = $this->gerar_datas_indisponiveis($this->view->bateria_list);

		$this->view->min_date = json_encode($date_time['min_date']);
		$this->view->max_date = json_encode($date_time['max_date']);
		$this->view->datas_indispovineis = json_encode($date_time['datas_indispovineis']);


		$this->view->paciente_list = $this->load_external_model('paciente')->load_pacientes_list(1);

		$alunos = $this->model->load_active_list('aluno');

		foreach ($alunos as $indice => $aluno) {
			if($aluno['tipo'] != 1){
				unset($alunos[$indice]);
			}
		};


		$this->view->aluno_list = $alunos;

		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		foreach ($this->model->load_active_list('hierarquia') as $indice => $hierarquia) {
			$hierarquias[$hierarquia['id']] = $hierarquia['nome'];
		};

		$this->view->bateria_list = $this->model->load_active_list($this->modulo['modulo']);
		$this->view->cadastro = $this->model->full_load_by_id($this->modulo['modulo'], $id[0])[0];

		$date_time = $this->gerar_datas_indisponiveis($this->view->bateria_list, $this->view->cadastro);

		$this->view->min_date = json_encode($date_time['min_date']);
		$this->view->max_date = json_encode($date_time['max_date']);
		$this->view->datas_indispovineis = json_encode($date_time['datas_indispovineis']);


		$this->view->relacoes_list = $this->model->full_load_by_column('bateria_relaciona_aluno_paciente', 'id_bateria', $id[0]);

		$this->view->paciente_list = $this->load_external_model('paciente')->load_pacientes_list(1);

		$alunos = $this->model->load_active_list('aluno');

		foreach ($alunos as $indice => $aluno) {
			if($aluno['tipo'] != 1){
				unset($alunos[$indice]);
			}
		};


		$this->view->aluno_list = $alunos;

		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$insert_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->create($this->modulo['modulo'], $insert_db);

		if($retorno['status']){
			$relacoes = carregar_variavel('relacao_aluno_paciente');

			foreach ($relacoes as $indice => $relacao) {
				$insert_ficha_clinica = [
					'ativo' => 1
				];

				$retorno_ficha_clinica[$indice] = $this->model->create('ficha_clinica', $insert_ficha_clinica);

				if($retorno_ficha_clinica[$indice]['status']){
					$insert_relacao = [
						'id_bateria' 		=> $retorno['id'] ,
						'id_aluno' 			=> $relacao['relacao']['aluno'],
						'id_paciente' 		=> $relacao['relacao']['paciente'],
						'id_ficha_clinica' 	=> $retorno_ficha_clinica[$indice]['id'],
					];

					$retorno_relacao[$indice] = $this->model->create('bateria_relaciona_aluno_paciente', $insert_relacao);
				}
			}
		}

		if($retorno['status'] && $retorno_ficha_clinica[1]['status'] && $retorno_relacao[1]['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		foreach ($this->model->load_active_list('hierarquia') as $indice => $hierarquia) {
			$hierarquias[$hierarquia['id']] = $hierarquia['nome'];
		};

		$relacao_bateria = $this->model->full_load_by_column('bateria_relaciona_aluno_paciente', 'id_bateria', $id[0]);
		$update_db = carregar_variavel($this->modulo['modulo']);
		$relacoes = carregar_variavel('relacao_aluno_paciente');

		debug2($relacao_bateria);
		debug2($relacoes);

		debug2($update_db);
				debug2($update_db);
		exit;

		if($retorno['status']){
			$relacoes = carregar_variavel('relacao_aluno_paciente');

			foreach ($relacoes as $indice => $relacao) {
				$insert_ficha_clinica = [
					'ativo' => 1
				];

				$retorno_ficha_clinica[$indice] = $this->model->create('ficha_clinica', $insert_ficha_clinica);

				if($retorno_ficha_clinica[$indice]['status']){
					$insert_relacao = [
						'id_bateria' 		=> $retorno['id'] ,
						'id_aluno' 			=> $relacao['relacao']['aluno'],
						'id_paciente' 		=> $relacao['relacao']['paciente'],
						'id_ficha_clinica' 	=> $retorno_ficha_clinica[$indice]['id'],
					];

					$retorno_relacao[$indice] = $this->model->create('bateria_relaciona_aluno_paciente', $insert_relacao);
				}
			}
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

		foreach ($this->model->load_active_list('hierarquia') as $indice => $hierarquia) {
			$hierarquias[$hierarquia['id']] = $hierarquia['nome'];
		};

		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	private function gerar_datas_indisponiveis($baterias, $cadastro = NULL){

		$hoje = \DateTime::createFromFormat('Y-m-d', \date('Y-m-d'));
		$min_date = $hoje->add( new \DateInterval( 'P1Y' ))->format('Y') . '-12-31';
		$max_date = ($hoje->add( new \DateInterval( 'P1Y' ))->format('Y') - 3) . '-01-01';

		$datas_indispovineis = [];



		foreach ($baterias as $indice => $bateria) {
			$date_data_inicio = \DateTime::createFromFormat('Y-m-d', $bateria['data_inicio']);
			$date_data_fim    = \DateTime::createFromFormat('Y-m-d', $bateria['data_fim']);

			$data_incremental = $date_data_inicio;

			while($data_incremental <= $date_data_fim){
				$datas_indispovineis[$data_incremental->format('Y-m-d')] = $data_incremental->format('Y-m-d');
				$data_incremental->add( new \DateInterval( 'P1D' ));
			}

		}
		if($cadastro != NULL){
			$date_disponivel_inicio = \DateTime::createFromFormat('Y-m-d', $cadastro['data_inicio']);
			$date_disponivel_fim    = \DateTime::createFromFormat('Y-m-d', $cadastro['data_fim']);
			unset($datas_indispovineis[$date_disponivel_inicio->format('Y-m-d')]);
			unset($datas_indispovineis[$date_disponivel_fim->format('Y-m-d')]);
		}

		return [
			'min_date'            => $max_date,
			'max_date'            => $min_date,
			'datas_indispovineis' => array_values($datas_indispovineis)
		];

	}
}



