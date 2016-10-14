<?php
namespace Models;

use Libs;

class Aluno_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function load_aluno($id){

		$select = 'SELECT aluno.id, aluno.nome, aluno.rgm, aluno.curso, aluno.semestre, aluno.turma,'
			. ' contato.contato, contato.tipo'
	    	. ' FROM aluno aluno'
    		. ' LEFT JOIN contato contato ON contato.id_aluno = aluno.id AND contato.ativo = 1'
	    	. ' WHERE aluno.id = ' . $id;

		$alunos = $this->db->select($select);

		$retorno = [
			'id' 			=> $alunos[0]['id'],
            'nome' 			=> $alunos[0]['nome'],
            'rgm' 			=> $alunos[0]['rgm'],
            'curso' 		=> $alunos[0]['curso'],
            'semestre' 		=> $alunos[0]['semestre'],
            'turma' 		=> $alunos[0]['turma'],
            'contato'		=> [
            ]
		];

		foreach ($alunos as $indice => $aluno) {
			$retorno['contato'][] = [
				'contato'	=> $aluno['contato'],
				'tipo'		=> $aluno['tipo']
			];
		}

		return $retorno;
	}
}
