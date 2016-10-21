<?php
namespace Models;

use Libs;

class Hierarquia_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function load_hierarquia($id){
		try {
			$select = 'SELECT hierarquia.id as id_hierarquia, hierarquia.nome,'
				. ' relacao.id as id_relacao,'
				. ' permissao.id as id_permissao, permissao.permissao'
				. ' FROM hierarquia hierarquia'
				. ' LEFT JOIN hierarquia_relaciona_permissao relacao'
				. ' ON relacao.id_hierarquia = hierarquia.id AND relacao.ativo = 1'
				. ' LEFT JOIN permissao permissao'
				. ' ON permissao.id = relacao.id_permissao'
				. ' WHERE hierarquia.id = ' . $id;

			foreach($this->db->select($select) as $indice => $permissao){
				$retorno[$permissao['id_permissao']] = $permissao;
			}

			return $retorno;
		}catch(Exception $e){
            if (ERROS) throw new Exception('<pre>' . $e->getMessage() . '</pre>');
			
		}
	}
}
