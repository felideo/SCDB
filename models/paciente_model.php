<?php
namespace Models;

use Libs;

class Paciente_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function create($table, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->get_insert($table, $data);
	}

	public function update($table, $id, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->db->update($table, $data, "`id` = {$id}");
	}

	public function load_pacientes_list($tipo){

		$select = 'SELECT paciente.id, paciente.nome, paciente.nascimento, paciente.patologia, paciente.sexo'
    	. ' FROM paciente paciente'
    	. ' WHERE paciente.ativo = 1'
    	. ' AND paciente.tipo = ' . $tipo;

		return $this->db->select($select);
	}

	public function load_paciente($id){
		$select = 'SELECT paciente.id as id_paciente, paciente.nome, paciente.pai,'
			. ' paciente.mae, paciente.nascimento, paciente.sexo, paciente.patologia,'
			. ' paciente.descricao, paciente.tipo as tipo_paciente,'
			. ' endereco.cep, endereco.rua, endereco.numero, endereco.complemento, endereco.bairro, endereco.cidade, endereco.uf,'
			. ' contato.contato, contato.tipo as tipo_contato'

	    	. ' FROM paciente paciente'
    		. ' LEFT JOIN endereco endereco ON endereco.id_paciente = paciente.id AND endereco.ativo = 1'
    		. ' LEFT JOIN contato contato ON contato.id_paciente = paciente.id AND contato.ativo = 1'
	    	. ' WHERE paciente.id = ' . $id;

		$pacientes = $this->db->select($select);

		$retorno = [
			'id' 			=> $pacientes[0]['id_paciente'],
            'nome' 			=> $pacientes[0]['nome'],
            'pai' 			=> $pacientes[0]['pai'],
            'mae' 			=> $pacientes[0]['mae'],
            'nascimento' 	=> $pacientes[0]['nascimento'],
            'sexo' 			=> $pacientes[0]['sexo'],
            'patologia' 	=> $pacientes[0]['patologia'],
            'descricao' 	=> $pacientes[0]['descricao'],
            'tipo' 			=> $pacientes[0]['tipo_paciente'],
            'endereco'		=> [
            	'cep'			=> $pacientes[0]['cep'],
            	'rua'			=> $pacientes[0]['rua'],
            	'numero'		=> $pacientes[0]['numero'],
            	'complemento'	=> $pacientes[0]['complemento'],
            	'bairro'		=> $pacientes[0]['bairro'],
            	'cidade'		=> $pacientes[0]['cidade'],
            	'uf'			=> $pacientes[0]['uf']
            ],
            'contato'			=> [
            ]
		];


		foreach ($pacientes as $indice => $paciente) {
			$retorno['contato'][] = [
				'contato'	=> $paciente['contato'],
				'tipo'		=> $paciente['tipo_contato']
			];
		}

		return $retorno;
	}
}
