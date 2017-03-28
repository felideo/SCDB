<?php
namespace Models;

use Libs;

class Classificacao_Model extends \Libs\Model{
	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca){
		$select = "SELECT"
			. " 	classificacao.id,"
			. " 	classificacao.nome,"
			. " 	ascendente.nome AS ascendente_nome"
			. " FROM"
			. " 	classificacao classificacao"
			. " LEFT JOIN classificacao ascendente"
			. " ON ascendente.id = classificacao.id_classificacao AND ascendente.ativo = 1"
			. " WHERE"
			. " 	classificacao.ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$select .= " AND classificacao.nome LIKE '%{$busca['search']['value']}%'";
			$select .= " OR ascendente.nome LIKE '%{$busca['search']['value']}%'";
		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$select .= " ORDER BY classificacao.id {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 1){
				$select .= " ORDER BY classificacao.nome {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 2){
				$select .= " ORDER BY ascendente.nome {$busca['order'][0]['dir']}";
			}
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
	}
}