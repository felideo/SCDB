<?php
namespace Model;
use Libs;


class Palavra_Chave extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function buscar_palavra_chave($busca){
		$select = "SELECT"
			. " 	palavra.id,"
			. " 	palavra.palavra"
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
