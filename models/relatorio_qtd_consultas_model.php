<?php
namespace Models;

use Libs;

/**
* Classe Index_Model
*/
class relatorio_qtd_consultas_model extends \Libs\Model{
	public function __construct() {
		parent::__construct();
	}

	public function gerar_relatorio_qtd_consultas($periodo){

		$hoje = \DateTime::createFromFormat('Y-m-d', \date('Y-m-d'))->format('Y-m-d');

		$select_pacientes = "SELECT agendamento.id AS id_agendamento, agendamento.presenca_paciente, agendamento.data,"
			. " relacao.id_paciente,"
			. " paciente.nome"
			. " FROM agendamento agendamento"
			. " LEFT JOIN bateria_relaciona_aluno_paciente relacao"
			. " ON relacao.id = agendamento.id_bateria_relaciona_aluno_paciente"
			. " LEFT JOIN paciente paciente ON paciente.id = relacao.id_paciente"
			. " WHERE agendamento.data >= '" . $periodo['data_inicio'] . "' AND agendamento.data <='" . $periodo['data_fim'] . "'"
			. " AND agendamento.presenca_paciente = 0 AND agendamento.ativo = 1";

	    $consultas_paciente = $this->db->select($select_pacientes);

	    $retorno = [];

	    if(!empty($consultas_paciente)){
	    	$retorno_pacientes = [];

	    	foreach ($consultas_paciente as $indice => $paciente) {
	    		$retorno_pacientes[$paciente['id_paciente']][] = $paciente;
	    	}

	    	foreach ($retorno_pacientes as $indice => $paciente) {
	    		$retorno[$indice] = [
	    			$retorno_pacientes[$indice][0]['id_paciente'],
	    			$retorno_pacientes[$indice][0]['nome'],
	    			count($retorno_pacientes[$indice]),
	    			$periodo['data_inicio'] . ' a ' . $periodo['data_fim']
    			];
	    	}
	    }

	    return $retorno;
	}


}
