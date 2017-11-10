<?php
namespace Models;
use Libs;
use \Libs\QueryBuilder\QueryBuilder;

/**
* Classe Index_Model
*/
class Palavra_Chave_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca){
		$query = new QueryBuilder($this->db);

		$query->select('
			palavra.id,
			palavra.palavra_chave,
		')
		->from('palavra_chave palavra')
		->where("palavra.ativo = 1");

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$query->where("palavra.id LIKE '%{$busca['search']['value']}%'", 'and')
				->where("palavra.palavra_chave LIKE '%{$busca['search']['value']}%'", 'or');
		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$query->orderBy("palavra.id {$busca['order'][0]['dir']}");
			}elseif($busca['order'][0]['column'] == 1){
				$query->orderBy("palavra.palavra_chave {$busca['order'][0]['dir']}");
			}
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$query->limit("{$busca['start']}, {$busca['length']}");
		}


		return $query->fetchArray();
	}

	public function buscar_palavra_chave($busca){
		$query = new QueryBuilder($this->db);

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
