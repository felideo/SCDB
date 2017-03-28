<?php
namespace Models;

use Libs;

/**
* Classe Index_Model
*/
class Organismo_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function buscar_nome_popular($busca){
		$select = "SELECT nome"
			. " FROM"
			. " 	nome_popular"
			. " WHERE"
			. " 	nome LIKE '%{$busca['nome']}%'"
			. " AND ativo = 1";

			if(isset($busca['page_limit'])){
				$select .= " LIMIT {$busca['page_limit']}";
			}

		return $this->db->select($select);
	}
}
