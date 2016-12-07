<?php
namespace Controllers;

use Libs;

class Agenda extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'agenda',
		'name'		=> 'Agenda',
		'send'		=> 'Agenda'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Data de Inicio', 'Data do Fim', 'Ações']);
		$this->listagem($this->model->load_active_list('bateria'));

		$agendamentos = $this->load_external_model('agendamento')->load_agendamentos_baterial_atual();
		$this->view->horarios_agendados = json_encode($this->criar_objeto_full_calendar($agendamentos));

		$this->view->render($this->modulo['modulo'] . '/listagem/listagem');
	}

	public function listagem($dados_linha){

		if(empty($dados_linha)){
			return false;
		}

		foreach ($dados_linha as $indice => $linha) {

			$data_inicio = $linha['data_inicio'];
			$data_fim    = $linha['data_fim'];

			$date_data_inicio = \DateTime::createFromFormat('Y-m-d', $data_inicio);
			$date_data_fim    = \DateTime::createFromFormat('Y-m-d', $data_fim);

			$date_hoje = new \DateTime();

			if($date_data_inicio < $date_hoje || $date_data_fim > $date_hoje){
				$this->view->bateria_atual = $this->model->carregar_bateria_atual($linha);
			}

			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id']}</td>",
		        "<td>{$linha['data_inicio']}</td>",
		        "<td>{$linha['data_fim']}</td>",
        		"<td>" . $this->view->default_buttons_listagem($linha['id']) . "</td>"
			];
		}

		if(isset($retorno_linhas)){
			$this->view->linhas_datatable = $retorno_linhas;
		}
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");
		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render($this->modulo['modulo'] . '/editar/editar');
		$this->view->lazy_view();
	}

	public function create(){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$agenda  = carregar_variavel('agenda');
		$bateria = carregar_variavel('bateria');

		if(isset($agenda['completo']) && $agenda['completo'] == 1){

			$data_inicio = $bateria['data_inicio'];
			$data_fim    = $bateria['data_fim'];

			$date_data_inicio = \DateTime::createFromFormat('Y-m-d', $data_inicio);
			$date_data_fim    = \DateTime::createFromFormat('Y-m-d', $data_fim);

			$data_incremental = \DateTime::createFromFormat('Y-m-d', $agenda['data_consulta']);

			while($data_incremental < $date_data_fim){

				$datas_consultas[] = $data_incremental->format('Y-m-d');
				$data_incremental->add( new \DateInterval( 'P7D' ));
			}

			foreach ($datas_consultas as $indice => $consulta) {
				$insert_consulta = [
					"data" => $consulta,
					"hora" => $agenda['hora_consulta'] . "00",
					"id_bateria_relaciona_aluno_paciente" => $agenda['id_bateria_relaciona_aluno_paciente']

				];

				$retorno_agendamento[] = $this->model->create('agendamento', $insert_consulta);
			}

		} else {

			$insert_consulta = [
				"data" => $agenda['data_consulta'],
				"hora" => $agenda['hora_consulta'] . "00",
				"id_bateria_relaciona_aluno_paciente" => $agenda['id_bateria_relaciona_aluno_paciente']

			];

			$retorno_agendamento[] = $this->model->create('agendamento', $insert_consulta);
		}

		if($retorno_agendamento[0]['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$update_db = carregar_variavel('usuario');

		if(empty($update_db['senha'])){
			unset($update_db['senha']);
		}

		$retorno = $this->model->update('usuario', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'usuario');
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		$retorno = $this->model->delete('agendamento', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . $this->modulo['modulo']);
	}


	public function verificar_horarios_disponiveis_ajax(){
		$data_escolhida = \DateTime::createFromFormat('d/m/Y', carregar_variavel('data_consulta'));
		$data = $data_escolhida->format('Y-m-d');

		$model_agendamento = $this->load_external_model('agendamento');
		$horarios_ocupados = $model_agendamento->verificar_horarios_disponiveis($data);

		$horarios_disponiveis = $this->verificar_horarios_disponiveis($horarios_ocupados, carregar_variavel('quantidade_atendimentos'));

		echo json_encode($horarios_disponiveis);
	}

	public function verificar_horarios_disponiveis($horarios_ocupados, $quantidade_atendimentos){
		$horarios_disponiveis = [];

		for($i = 8; $i < 19; $i++ ){
			$hora = \DateTime::createFromFormat('G', $i)->format('H:i:s');
			$horarios_disponiveis[$hora] = $quantidade_atendimentos;
		}

		foreach ($horarios_ocupados as $indice => $horario) {
			if(isset($horarios_disponiveis[$horario['hora']])){
				$horarios_disponiveis[$horario['hora']]--;
			}

			if(isset($horarios_disponiveis[$horario['hora']]) && $horarios_disponiveis[$horario['hora']] == 0 ){
				unset($horarios_disponiveis[$horario['hora']]);
			}
		}

		foreach ($horarios_disponiveis as $indice => $horario) {
			$horarios_disponiveis[$indice] = $indice;
		}

		return $horarios_disponiveis;
	}

	private function criar_objeto_full_calendar($agendamentos){
		if(empty($agendamentos)){
			return false;
		}

		foreach ($agendamentos as $indice => $horario) {
			if(empty($horario['id_agendamento']) && empty($horario['data'])){
				continue;
			}


			$retorno[] = [
				'id'        => $horario['id_agendamento'],
				'title'     => $horario['paciente_nome'],
				'start'     => $horario['data'] . ' ' . $horario['hora'],
				'className' => 'muda_1' . $horario['paciente_nome'] . 'muda_2muda_3' . $horario['aluno_nome']
			];
		}

		return isset($retorno) ? $retorno : false;
	}

	public function fazer_chamada($dados){
		if($dados[3] != 'undefined'){
			$update_db = [
				'presenca_paciente' => $dados[1] == 'falta' ? 1 : 0
			];

			$where = "id = {$dados[0]}";
		}

		if($dados[2] != 'undefined'){
			$update_db = [
				'presenca_aluno' => $dados[1] == 'falta' ? 1 : 0
			];

			$where = "id = {$dados[0]}";
		}

		$retorno = $this->model->db->update('agendamento', $update_db, $where);

		if($retorno['status']){
			$this->view->alert_js('Alteração efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a alteração do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: ' . URL . 'painel_controle');
	}
}