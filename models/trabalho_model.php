<?php
namespace Models;

use Libs;
use \Libs\QueryBuilder\QueryBuilder;

class trabalho_model extends \Libs\Model{
	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca){
		$select = "SELECT"
			. " 	trabalho.id,"
			. " 	trabalho.titulo,"
			. " 	autor.nome,"
			. " 	relacao.id_palavra_chave,"
			. " 	palavra.palavra_chave"
			. " FROM"
			. " 	trabalho trabalho"
			. " LEFT JOIN autor autor"
			. "  	ON autor.id = trabalho.id_autor AND autor.ativo = 1"
			. " LEFT JOIN trabalho_relaciona_palavra_chave relacao"
			. "  	ON relacao.id_trabalho = trabalho.id AND relacao.ativo = 1"
			. " LEFT JOIN palavra_chave palavra"
			. "  	ON palavra.id = relacao.id_palavra_chave AND palavra.ativo = 1"
			. " WHERE"
			. " 	trabalho.ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$select .= " AND trabalho.id LIKE '%{$busca['search']['value']}%'";
			$select .= " OR trabalho.titulo LIKE '%{$busca['search']['value']}%'";
			$select .= " OR autor.nome LIKE '%{$busca['search']['value']}%'";
			$select .= " OR palavra.palavra LIKE '%{$busca['search']['value']}%'";

		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$select .= " ORDER BY trabalho.id {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 1){
				$select .= " ORDER BY trabalho.titulo {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 2){
				$select .= " ORDER BY autor.nome {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 3){
				$select .= " ORDER BY palavra.palavra {$busca['order'][0]['dir']}";
			}
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
	}

	public function carregar_trabalho($id){
		$query = new QueryBuilder($this->db);

		$query->select('autor.*, trabalho.*, rel_palavra.*, palavra.*, arquivo.*, idioma.*')
			->from('trabalho trabalho')
			->leftJoin('autor autor'
				. ' ON autor.id = trabalho.id_autor'
			)
			->leftJoin('trabalho_relaciona_palavra_chave rel_palavra'
				. ' ON rel_palavra.id_trabalho = trabalho.id'
			)
			->leftJoin('palavra_chave palavra'
				. 	' ON palavra.id = rel_palavra.id_palavra_chave'
			)
			->leftJoin('arquivo arquivo'
				. ' ON arquivo.id = trabalho.id_arquivo'
			)
			->leftJoin('idioma idioma'
				. ' ON idioma.id = trabalho.id_idioma'
			)
			->where("trabalho.id = {$id}");

		return $query->fetchArray()[0];
	}
}