<?php
namespace Models;
use Libs;

/**
* Classe Index_Model
*/
class Autor_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca){
		$select = "SELECT"
			. " 	autor.id,"
			. " 	autor.nome,"
			. " 	autor.email,"
			. " 	autor.link"
			. " FROM"
			. " 	autor autor"
			. " WHERE"
			. " 	autor.ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$select .= " AND autor.id LIKE '%{$busca['search']['value']}%'";
			$select .= " OR autor.nome LIKE '%{$busca['search']['value']}%'";
			$select .= " OR autor.email LIKE '%{$busca['search']['value']}%'";
			$select .= " OR autor.link LIKE '%{$busca['search']['value']}%'";
		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$select .= " ORDER BY autor.id {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 1){
				$select .= " ORDER BY autor.nome {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 2){
				$select .= " ORDER BY autor.email {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 3){
				$select .= " ORDER BY autor.link {$busca['order'][0]['dir']}";
			}
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
	}

	public function buscar_autor($busca){
		$select = "SELECT"
			. " 	autor.id,"
			. " 	autor.nome,"
			. " 	autor.email,"
			. " 	autor.link"
			. " FROM"
			. " 	autor autor"
			. " WHERE"
			. " 	autor.nome LIKE '%{$busca['nome']}%'"
			. " AND autor.ativo = 1";

			if(isset($busca['page_limit'])){
				$select .= " LIMIT {$busca['page_limit']}";
			}

		return $this->db->select($select);
	}




}
