<?php
namespace Model;
use Libs;
use \Libs\QueryBuilder\QueryBuilder;


class Palavra_Chave extends \Framework\Model{
	public function buscar_palavra_chave($busca){
		$this->query->select('
			palavra.id,
			palavra.palavra_chave
		')
			->from('palavra_chave palavra')
			->where("palavra.palavra_chave LIKE '%{$busca['nome']}%' AND palavra.ativo = 1");

		if(isset($busca['page_limit'])){
			$this->query->limit($busca['page_limit']);
		}

		return $this->query->fetchArray();
	}
}
