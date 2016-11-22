<?php
namespace Models;

use Libs;

class agendamento_model extends \Libs\Model{

	public function __construct() {
		parent::__construct();
	}

	public function verificar_horarios_disponiveis($data){
		$select = "SELECT * FROM agendamento WHERE data = '{$data}' ORDER BY data ASC";
		return $this->db->select($select);
	}

	public function load_agendamentos_baterial_atual(){
		$hoje = \date("Y-m-d");

		$select = 'SELECT bateria.id as id_bateria,'
			. ' agendamento.id as id_agendamento, agendamento.data, agendamento.hora,'
			. ' relacao.id_aluno, relacao.id_paciente, relacao.id as id_relacao,'
			// . ' aluno.nome as aluno_nome,'
			. ' paciente.nome as paciente_nome'
	    	. ' FROM bateria bateria'
			. ' LEFT JOIN bateria_relaciona_aluno_paciente relacao ON relacao.id_bateria = bateria.id AND relacao.ativo = 1'
			// . ' LEFT JOIN aluno aluno ON aluno.id = relacao.id_aluno AND aluno.ativo = 1'
			. ' LEFT JOIN paciente paciente ON paciente.id = relacao.id_paciente AND paciente.ativo = 1'
			. ' LEFT JOIN agendamento agendamento ON agendamento.id_bateria_relaciona_aluno_paciente = relacao.id AND agendamento.ativo = 1'
			. " WHERE bateria.data_inicio < '{$hoje}' AND bateria.data_fim > '{$hoje}' AND bateria.ativo = 1";

		return $this->db->select($select);
	}
}