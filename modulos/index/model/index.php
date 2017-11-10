<?php
namespace Model;

class Index extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function carregar_imagens_aleatorias(){
		return $this->get_query()
			->select('
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

