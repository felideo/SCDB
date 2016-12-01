<?php
namespace Models;

use Libs;

/**
* Classe Index_Model
*/
class painel_controle_model extends \Libs\Model{
	public function __construct() {
		parent::__construct();
	}

	public function carregar_chamada(){

		$hoje = \DateTime::createFromFormat('Y-m-d', \date('Y-m-d'))->format('Y-m-d');

		$select = "SELECT bateria.data_inicio, bateria.data_fim,"
			. " relacao.id AS id_relacao,"
			. " agendamento.data AS agendamento_data, agendamento.hora, agendamento.presenca_aluno, agendamento.presenca_paciente, agendamento.id AS id_agendamento,"
			. " aluno.nome AS nome_aluno, aluno.id AS id_aluno,"
			. " paciente.nome AS nome_paciente, paciente.id AS id_paciente"
			. " FROM bateria bateria"
			. " LEFT JOIN bateria_relaciona_aluno_paciente relacao"
			. " ON relacao.id_bateria = bateria.id AND relacao.ativo = 1"
			. " LEFT JOIN agendamento agendamento"
			. " ON id_bateria_relaciona_aluno_paciente = relacao.id AND agendamento.ativo = 1"
			. " AND agendamento.data <= '{$hoje}' AND (agendamento.presenca_aluno IS NULL OR agendamento.presenca_paciente IS NULL)"
			. " LEFT JOIN aluno aluno"
			. " ON aluno.id = relacao.id_aluno"
			. " LEFT JOIN paciente paciente"
			. " ON paciente.id = relacao.id_paciente AND paciente.tipo = 1"
			. " WHERE bateria.data_inicio <= '{$hoje}' AND bateria.data_fim >= '{$hoje}' AND bateria.ativo = 1";

	    return $this->db->select($select);
	}
}
