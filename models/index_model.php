<?php
namespace Models;

use Libs;
use \Libs\QueryBuilder\QueryBuilder;

/**
* Classe Index_Model
*/
class Index_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function carregar_imagens_aleatorias(){
		$query = new QueryBuilder($this->db);

		return $query->select('
			relacao.*,
			imagem.*
		')
			->from('organismo_relaciona_imagem relacao')
			->leftJoin('arquivo imagem ON imagem.id = relacao.id_arquivo')
			->where('relacao.ativo = 1')
			->orderBy('rand()')
			->limit(10)
			->fetchArray();
	}
}
