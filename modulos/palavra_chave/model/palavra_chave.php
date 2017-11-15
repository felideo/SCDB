<?php
namespace Model;
use Libs;


class Palavra_Chave extends \Libs\Model {
<<<<<<< HEAD
	public function __construct() {
		parent::__construct();
	}

=======
>>>>>>> d895410... DEV - SWDB * ajuste final em todos os modulos na nova estrutura * incremento na abstração do carregamento do datatable!
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
