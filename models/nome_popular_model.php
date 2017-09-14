<?php
namespace Models;

use Libs;

class Nome_Popular_model extends \Libs\Model{
	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca){
		$select = "SELECT"
			. " 	popular.id,"
			. " 	popular.nome,"
			. " 	relacao.id AS id_relacao,"
			. " 	organismo.nome AS nome_organismo"
			. " FROM"
			. " 	nome_popular popular"
			. " LEFT JOIN organismo_relaciona_nome_popular relacao"
			. " 	ON relacao.id_nome_popular = popular.id AND relacao.ativo = 1"
			. " LEFT JOIN organismo organismo"
			. " 	ON organismo.id = relacao.id_organismo AND organismo.ativo = 1"
			. " WHERE"
			. " 	popular.ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$select .= " AND popular.id LIKE '%{$busca['search']['value']}%'";
			$select .= " OR popular.nome LIKE '%{$busca['search']['value']}%'";
			$select .= " OR organismo.nome LIKE '%{$busca['search']['value']}%'";
		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$select .= " ORDER BY popular.id {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 1){
				$select .= " ORDER BY popular.nome {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 2){
				$select .= " ORDER BY organismo.nome {$busca['order'][0]['dir']}";
			}
		}


		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
	}
}