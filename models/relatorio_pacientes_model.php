<?php
namespace Models;

use Libs;

/**
* Classe Index_Model
*/
class relatorio_pacientes_model extends \Libs\Model{
	public function __construct() {
		parent::__construct();
	}

	public function gerar_relatorio_pacientes($bateria){
		$select = "SELECT paciente.nome, paciente.pai, paciente.mae, paciente.nascimento, paciente.sexo, paciente.patologia,"
			. " relacao.id_bateria, relacao.id_ficha_clinica"
			. " FROM paciente paciente"
			. " LEFT JOIN bateria_relaciona_aluno_paciente relacao ON relacao.id_paciente = paciente.id"
			. " WHERE relacao.id_bateria = {$bateria}";


	    $pacientes = $this->db->select($select);

	    $retorno = [];

	    if(!empty($pacientes)){
	    	$retorno_pacientes = [];

	    	foreach ($pacientes as $indice => $paciente) {
	    		$retorno[] = [
	    			$paciente['nome'],
	    			$paciente['pai'],
	    			$paciente['mae'],
	    			$paciente['sexo'],
	    			$paciente['nascimento'],
	    			$paciente['patologia'],
	    			URL . 'ficha_clinica/visualizar/' . $paciente['id_ficha_clinica']
    			];
	    	}
	    }

	    return $retorno;
	}


}