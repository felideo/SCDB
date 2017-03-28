<?php
namespace Models;

use Libs;

class taxon_model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca){
		$select = "SELECT"
			. " 	taxon.id,"
			. " 	taxon.nome,"
			. " 	taxon.id_taxon,"
			. " 	ascendente.nome AS ascendente_nome,"
			. "  	classificacao.nome As classificacao_nome"
			. " FROM"
			. " 	taxon taxon"
			. " LEFT JOIN taxon ascendente"
			. " ON ascendente.id = taxon.id_taxon AND ascendente.ativo = 1"
			. " LEFT JOIN classificacao classificacao"
			. " ON classificacao.id = taxon.id_classificacao AND classificacao.ativo = 1"
			. " WHERE"
			. " 	taxon.ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$select .= " AND taxon.nome LIKE '%{$busca['search']['value']}%'";
			$select .= " OR ascendente.nome LIKE '%{$busca['search']['value']}%'";
			$select .= " OR classificacao.nome LIKE '%{$busca['search']['value']}%'";
		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$select .= " ORDER BY taxon.id {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 1){
				$select .= " ORDER BY taxon.nome {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 2){
				$select .= " ORDER BY ascendente.nome {$busca['order'][0]['dir']}";
			}
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
	}

	public function carregar_taxon($id){
		$select = "SELECT"
			. " 	taxon.id,"
			. " 	taxon.nome,"
			. " 	taxon.id_taxon,"
			. " 	taxon.id_classificacao,"
			. " 	ascendente.nome AS ascendente_nome,"
			. " 	ascendente.id AS ascendente_id,"
			. "  	classificacao.nome As classificacao_nome,"
			. "  	classificacao.id As classificacao_id"
			. " FROM"
			. " 	taxon taxon"
			. " LEFT JOIN taxon ascendente"
			. " 	ON ascendente.id = taxon.id_taxon AND ascendente.ativo = 1"
			. " LEFT JOIN classificacao classificacao"
			. " 	ON classificacao.id = taxon.id_classificacao AND classificacao.ativo = 1"
			. " WHERE"
			. " 	taxon.id = {$id}"
			. " AND taxon.ativo = 1";

		return $this->db->select($select);
	}

	public function buscar_taxon($busca){
		$select = "SELECT"
			. " 	taxon.id,"
			. " 	taxon.nome,"
			. " 	taxon.id_taxon"
			. " FROM"
			. " 	taxon taxon"
			. " WHERE"
			. " 	taxon.nome LIKE '%{$busca['nome']}%'"
			. " AND taxon.ativo = 1";

			if(isset($busca['id_classificacao']) && !empty($busca['id_classificacao'])){
				$select .= " AND taxon.id_classificacao = {$busca['id_classificacao']}";
			}

			if(isset($busca['id_ascendente']) && !empty($busca['id_ascendente']) && $busca['id_ascendente'] != 'NULL'){
				$select .= " AND taxon.id_taxon = {$busca['id_ascendente']}";
			}

			if(isset($busca['page_limit'])){
				$select .= " LIMIT {$busca['page_limit']}";
			}

		return $this->db->select($select);
	}

	public function buscar_ascendencia($id_ascendente){
		$query = $this->buscar_taxon_by_id($id_ascendente);
		$retorno[$query['id_classificacao']] = $query;

		while (!empty(end($retorno)['id_taxon'])) {
			$query = $this->buscar_taxon_by_id($id_ascendente);
			$retorno[$query['nome_classificacao']] = $query;
			$retorno[$query['nome_classificacao']]['index'] =  str_replace('/', '_', strtolower(Libs\CleanString::remover_acentos($query['nome_classificacao'])));
			$id_ascendente = $query['id_taxon'];
		}

		return array_values($retorno);
	}

	private function buscar_taxon_by_id($id_taxon){
		$select = "SELECT"
			. " 	taxon.id,"
			. " 	taxon.nome,"
			. " 	taxon.id_taxon,"
			. " 	taxon.id_classificacao,"
			. " 	classificacao.nome AS nome_classificacao"
			. " FROM"
			. " 	taxon taxon"
			. " LEFT JOIN classificacao classificacao"
			. " 	ON taxon.id_classificacao = classificacao.id"
			. " WHERE"
			. " 	taxon.id = {$id_taxon}";

		return $this->db->select($select)[0];
	}
}