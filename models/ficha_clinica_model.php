<?php
namespace Models;

use Libs;

class Ficha_Clinica_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function load_ficha_clinica_list(){
		$select = 'SELECT relacao.id as id_relacao, relacao.id_bateria, relacao.id_aluno, relacao.id_paciente, relacao.id_ficha_clinica,'
			. ' bateria.data_inicio as bateria_data_inicio, bateria.data_fim as bateria_data_fim,'
			. ' aluno.nome as aluno_nome, aluno.id_usuario as id_usuario,'
			. ' paciente.nome as nome_paciente, paciente.pai as nome_pai_paciente, paciente.mae as nome_mae_paciente, paciente.nascimento as nascimento_paciente, paciente.patologia as patologia_paciente,'
			. ' ficha_clinica.id, ficha_clinica.ativo AS ativo_ficha'
	    	. ' FROM bateria_relaciona_aluno_paciente relacao'
    		. ' LEFT JOIN bateria bateria ON bateria.id = relacao.id_bateria AND bateria.ativo = 1'
    		. ' LEFT JOIN aluno aluno ON aluno.id = relacao.id_aluno AND aluno.ativo = 1'
    		. ' LEFT JOIN paciente paciente ON paciente.id = relacao.id_paciente AND aluno.ativo = 1'
    		. ' LEFT JOIN ficha_clinica ficha_clinica ON ficha_clinica.id = relacao.id_ficha_clinica'

	    	. ' WHERE relacao.ativo = 1 AND ficha_clinica.ativo = 1';

	    return $this->db->select($select);
	}

	public function load_ficha_clinica($id_ficha_clinica){

		$select = 'SELECT relacao.id as id_relacao, relacao.id_bateria, relacao.id_aluno, relacao.id_paciente, relacao.id_ficha_clinica,'
			. ' bateria.data_inicio as bateria_data_inicio, bateria.data_fim as bateria_data_fim, bateria.atendimentos_simultaneos,'
			. ' aluno.nome as aluno_nome,'
			. ' paciente.nome as nome_paciente, paciente.pai as nome_pai_paciente, paciente.mae as nome_mae_paciente, paciente.nascimento as nascimento_paciente,'
			. ' paciente.patologia as patologia_paciente, paciente.descricao as paciente_descricao, paciente.sexo,'
			. ' endereco.cep, endereco.rua, endereco.numero, endereco.complemento, endereco.bairro, endereco.cidade, endereco.uf,'
			. ' contato.contato, contato.tipo as tipo_contato,'
			. ' ficha_clinica.*'
	    	. ' FROM bateria_relaciona_aluno_paciente relacao'
    		. ' LEFT JOIN bateria bateria ON bateria.id = relacao.id_bateria AND bateria.ativo = 1'
    		. ' LEFT JOIN aluno aluno ON aluno.id = relacao.id_aluno AND aluno.ativo = 1'
    		. ' LEFT JOIN paciente paciente ON paciente.id = relacao.id_paciente AND aluno.ativo = 1'
    		. ' LEFT JOIN endereco endereco ON endereco.id_paciente = relacao.id_paciente AND endereco.ativo = 1'
    		. ' LEFT JOIN contato contato ON contato.id_paciente = paciente.id AND contato.ativo = 1'
    		. ' LEFT JOIN ficha_clinica ficha_clinica ON ficha_clinica.id = relacao.id_ficha_clinica AND ficha_clinica.ativo = 1'


	    	. ' WHERE relacao.id_ficha_clinica = ' . $id_ficha_clinica;

	    	$ficha_clinica = $this->db->select($select);

			$retorno = [
	            'endereco'		=> [
	            	'cep'			=> $ficha_clinica[0]['cep'],
	            	'rua'			=> $ficha_clinica[0]['rua'],
	            	'numero'		=> $ficha_clinica[0]['numero'],
	            	'complemento'	=> $ficha_clinica[0]['complemento'],
	            	'bairro'		=> $ficha_clinica[0]['bairro'],
	            	'cidade'		=> $ficha_clinica[0]['cidade'],
	            	'uf'			=> $ficha_clinica[0]['uf']
	            ],
	            'contato'			=> [
	            ]
			];


			foreach ($ficha_clinica as $indice => $contato) {
				$retorno['contato'][] = [
					'contato'	=> $contato['contato'],
					'tipo'		=> $contato['tipo_contato']
				];
			}

			unset($ficha_clinica[0]['cep']);
			unset($ficha_clinica[0]['rua']);
			unset($ficha_clinica[0]['numero']);
			unset($ficha_clinica[0]['complemento']);
			unset($ficha_clinica[0]['bairro']);
			unset($ficha_clinica[0]['cidade']);
			unset($ficha_clinica[0]['uf']);
			unset($ficha_clinica[0]['contato']);
			unset($ficha_clinica[0]['tipo_contato']);

		    return $ficha_clinica[0] += $retorno;
		}

	}

