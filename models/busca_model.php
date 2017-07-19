<?php
namespace Models;

use Libs;
// use \Libs\QueryBuilder\QueryBuilder;
// include "vendor/felideotrine/query-builder/FelideoTrine/QueryBuilder.php";
// use \Felideo\FelideoTrine;
/**
* Classe Index_Model
*/
class Busca_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function efetuar_busca($busca){

		// debug2($busca);
		// exit;

		$query = new \Felideo\FelideoTrine\QueryBuilder($this->db);

		$query->select('
			organismo.nome,
			organismo.descricao,
			popular.nome,
		')
		->from('organismo organismo')
		->leftJoin('nome_popular popular ON popular.id = organismo.id AND popular.ativo = 1');

		if(!empty($busca['id_taxon'])){
			$query->where("organismo.localizador LIKE '%-{$busca['id_taxon']}-%'");
		}

		if(!empty($busca['id_nome_popular'])){
			$query->where("popular.id = {$busca['id_nome_popular']}");
		}

		if(!empty($busca['numero_petalas'])){
			$query->where("organismo.numero_petalas = {$busca['numero_petalas']}");
		}

		if(!empty($busca['numero_estames'])){
			$query->where("organismo.numero_estames = {$busca['numero_estames']}");
		}

		if(!empty($busca['forma_folha'])){
			$query->where("organismo.forma_folha = {$busca['forma_folha']}");
		}

		$query->where("organismo.ativo = 1");

		return $query->fetchArray();
	}
}
