<?php
namespace Models;

use Libs;
use \Libs\QueryBuilder\QueryBuilder;
// include "vendor/felideotrine/query-builder/FelideoTrine/QueryBuilder.php";
// use \Felideo\FelideoTrine;
/**
* Classe Index_Model
*/
class Organismo_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function buscar_nome_popular($busca){
		$select = "SELECT nome, id"
			. " FROM"
			. " 	nome_popular"
			. " WHERE"
			. " 	nome LIKE '%{$busca['nome']}%'"
			. " AND ativo = 1";

			if(isset($busca['page_limit'])){
				$select .= " LIMIT {$busca['page_limit']}";
			}

		return $this->db->select($select);
	}

	public function get_min_max_n_petalas_e_estames(){

		$select_min_n_petalas = "SELECT MIN(numero_petalas) as min_n_petalas FROM organismo";
		$select_max_n_petalas = "SELECT MAX(numero_petalas) as max_n_petalas FROM organismo";
		$select_min_n_estames = "SELECT MIN(numero_estames) as min_n_estames FROM organismo";
		$select_max_n_estames = "SELECT MAX(numero_estames) as max_n_estames FROM organismo";

		$retorno = [
			'min_n_petalas' => $this->db->select($select_min_n_petalas)[0]['min_n_petalas'],
			'max_n_petalas' => $this->db->select($select_max_n_petalas)[0]['max_n_petalas'],
			'min_n_estames' => $this->db->select($select_min_n_estames)[0]['min_n_estames'],
			'max_n_estames' => $this->db->select($select_max_n_estames)[0]['max_n_estames'],
		];

		return $retorno;
	}
	public function get_min_max_n_estames(){

	}

	public function carregar_organismo($id){

		$query = new QueryBuilder($this->db);

		$query->select('
			hhh.*,

			rel_pop_name.id_nome_popular,
			popular.nome,
			geografica.latitude, geografica.longitude,
			rel_imagem.id_arquivo,
			imagem.hash, imagem.nome,
			imagem.endereco,
			imagem.extensao,

			rel_trabalho.id,
			rel_trabalho.id_organismo,
			rel_trabalho.id_trabalho,
			rel_trabalho.ativo,

			trabalho_arquivo.hash,
			trabalho_arquivo.nome,
			trabalho_arquivo.endereco,
			trabalho_arquivo.extensao,

			trabalho.id,
			trabalho.titulo,
			trabalho.ano,
			trabalho.resumo,
			trabalho.link_trabalho,
			trabalho.id_arquivo,
			trabalho.id_idioma,
			trabalho.id_autor,
			trabalho.ativo,

			idioma.idioma,
			autor.nome,
			autor.email,
			autor.link,
			rel_palavra.id_palavra_chave,
			palavra.palavra_chave,
			taxon.nome,
			classificacao.nome
		')
		->from('organismo hhh')
		->leftJoin('organismo_relaciona_nome_popular rel_pop_name'
				. ' ON rel_pop_name.id_organismo = hhh.id AND rel_pop_name.ativo = 1')
		->leftJoin('nome_popular popular'
				. ' ON popular.id = rel_pop_name.id_nome_popular AND popular.ativo = 1')
		->leftJoin('posicao_geografica geografica'
				. ' ON geografica.id_organismo = hhh.id AND geografica.ativo = 1')
		->leftJoin('organismo_relaciona_imagem rel_imagem'
				. ' ON rel_imagem.id_organismo = hhh.id AND rel_imagem.ativo = 1 ')
		->leftJoin('arquivo imagem'
				. ' ON imagem.id = rel_imagem.id_arquivo AND imagem.ativo = 1')
		->leftJoin('organismo_relaciona_trabalho rel_trabalho'
				. ' ON rel_trabalho.id_organismo = hhh.id AND rel_trabalho.ativo = 1')
		->leftJoin('trabalho trabalho'
				. ' ON trabalho.id = rel_trabalho.id_trabalho AND trabalho.ativo = 1')
		->leftJoin('arquivo trabalho_arquivo'
				. ' ON trabalho_arquivo.id = trabalho.id_arquivo AND trabalho_arquivo.ativo = 1')
		->leftJoin('idioma idioma'
				. ' ON idioma.id = trabalho.id_idioma AND idioma.ativo = 1')
		->leftJoin('autor autor'
				. ' ON autor.id = trabalho.id_autor AND autor.ativo = 1')
		->leftJoin('trabalho_relaciona_palavra_chave rel_palavra'
				. ' ON rel_palavra.id_trabalho = trabalho.id AND rel_palavra.ativo = 1')
		->leftJoin('palavra_chave palavra'
				. ' ON palavra.id = rel_palavra.id_palavra_chave AND palavra.ativo = 1')
		->leftJoin('taxon taxon'
				. ' ON taxon.id = hhh.id_last_taxon')
		->leftJoin('classificacao classificacao'
				. ' ON classificacao.id = taxon.id_classificacao')
		->where("hhh.id = {$id}"
			. " AND hhh.ativo = 1");

		// debug2($query->getQuery());
		// debug2($query->fetchArray());
		// exit;


		return $query->fetchArray()[0];
	}
}
