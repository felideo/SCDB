<?php
namespace Models;
use Libs;

/**
* Classe Index_Model
*/
class Palavra_Chave_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function buscar_autor($busca){
		$select = "SELECT"
			. " 	palavra.id,"
			. " 	palavra.palavra,"
			. " FROM"
			. " 	palavra_chave palavra"
			. " WHERE"
			. " 	palavra.palavra LIKE '%{$busca['nome']}%'"
			. " AND palavra.ativo = 1";

			if(isset($busca['page_limit'])){
				$select .= " LIMIT {$busca['page_limit']}";
			}

		return $this->db->select($select);
	}
}
