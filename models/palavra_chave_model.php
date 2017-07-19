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

	public function buscar_palavra_chave($busca){
		$query = new \Felideo\FelideoTrine\QueryBuilder($this->db);

		$query->select('
			palavra.id,
			palavra.palavra_chave
		')
			->from('palavra_chave palavra')
			->where("palavra.palavra_chave LIKE '%{$busca['nome']}%' AND palavra.ativo = 1");

		if(isset($busca['page_limit'])){
			$query->limit($busca['page_limit']);
		}

		return $query->fetchArray();
	}
}
