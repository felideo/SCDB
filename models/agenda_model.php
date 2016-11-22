<?php
namespace Models;

use Libs;

class agenda_model extends \Libs\Model{

	public function __construct() {
		parent::__construct();
	}

	public function carregar_bateria_atual($bateria_atual){
		$select = 'SELECT bateria.id, bateria.data_inicio, bateria.data_fim, bateria.atendimentos_simultaneos,'
		. ' relacao.id_aluno, relacao.id_paciente, relacao.id as id_relacao,'
		. ' aluno.nome as aluno_nome,'
		. ' paciente.nome as paciente_nome'
    	. ' FROM bateria bateria'
		. ' LEFT JOIN bateria_relaciona_aluno_paciente relacao ON relacao.id_bateria = bateria.id AND relacao.ativo = 1'
		. ' LEFT JOIN aluno aluno ON aluno.id = relacao.id_aluno AND aluno.ativo = 1'
		. ' LEFT JOIN paciente paciente ON paciente.id = relacao.id_paciente AND paciente.ativo = 1'
    	. ' WHERE bateria.id = ' . $bateria_atual['id'];

	    return $this->db->select($select);
	}
}