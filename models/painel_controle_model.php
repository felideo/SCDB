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

	public function carregar_faltas(){

		$hoje = \DateTime::createFromFormat('Y-m-d', \date('Y-m-d'))->format('Y-m-d');

		$select_pacientes = "SELECT agendamento.id AS id_agendamento, agendamento.presenca_paciente, relacao.id_paciente"
			. " FROM agendamento agendamento"
			. " LEFT JOIN bateria_relaciona_aluno_paciente relacao"
			. " ON relacao.id = agendamento.id_bateria_relaciona_aluno_paciente"
			. " WHERE agendamento.id IN (SELECT id FROM agendamento WHERE presenca_paciente IS NOT NULL)"
			. " AND agendamento.ativo = 1";

		$select_alunos = "SELECT agendamento.id AS id_agendamento, agendamento.presenca_aluno, relacao.id_aluno"
			. " FROM agendamento agendamento"
			. " LEFT JOIN bateria_relaciona_aluno_paciente relacao"
			. " ON relacao.id = agendamento.id_bateria_relaciona_aluno_paciente"
			. " WHERE agendamento.id IN (SELECT id FROM agendamento WHERE presenca_aluno IS NOT NULL)"
			. " AND agendamento.ativo = 1";



	    $faltas_paciente = $this->db->select($select_pacientes);
	    $faltas_aluno = $this->db->select($select_alunos);

	    $retorno = [];

	    if(!empty($faltas_paciente)){
	    	$retorno_pacientes = [];

	    	foreach ($faltas_paciente as $indice => $paciente) {
	    		if(!isset($retorno_pacientes[$paciente['id_paciente']])){
	    			$retorno_pacientes[$paciente['id_paciente']] = 1;
	    		} else {
	    			$retorno_pacientes[$paciente['id_paciente']] = $retorno_pacientes[$paciente['id_paciente']] + $paciente['presenca_paciente'];
	    		}
	    	}

	    	foreach ($retorno_pacientes as $indice => $paciente) {
	    		if($paciente >= 2){
	    			$retorno['pacientes'][] = [
	    				'id_paciente' => $indice,
	    				'faltas'      => $paciente,
	    				'nome'        => $this->db->select("SELECT nome FROM paciente WHERE id = {$indice}")[0]['nome']
	    			];
	    		}
	    	}
	    }

	    if(!empty($faltas_aluno)){
	    	$retorno_alunos = [];

	    	foreach ($faltas_aluno as $indice => $aluno) {
	    		if(!isset($retorno_alunos[$aluno['id_aluno']])){
	    			$retorno_alunos[$aluno['id_aluno']] = 1;
	    		} else {
	    			$retorno_alunos[$aluno['id_aluno']] = $retorno_alunos[$aluno['id_aluno']] + $aluno['presenca_aluno'];
	    		}
	    	}

	    	foreach ($retorno_alunos as $indice => $aluno) {
	    		if($aluno >= 2){
	    			$retorno['alunos'][] = [
	    				'id_alunos' => $indice,
	    				'faltas'      => $aluno,
	    				'nome'        => $this->db->select("SELECT nome FROM aluno WHERE id = {$indice}")[0]['nome']
	    			];
	    		}
	    	}
	    }

	    return $retorno;
	}
}
