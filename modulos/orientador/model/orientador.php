<?php
namespace Model;
use Libs;

class Orientador extends \Framework\Model{
	public function carregar_listagem($busca, $datatable){
		$this->query->select('
				pessoa.*,
				usuario.*
			')
			->from('pessoa pessoa')
			->innerJoin('usuario usuario ON usuario.id = pessoa.id_usuario AND usuario.ativo = 1')
			->where('pessoa.ativo = 1 AND pessoa.orientador = 1');

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$this->query->andWhere("pessoa.id LIKE '%{$busca['search']['value']}%'"
				. " OR usuario.email LIKE '%{$busca['search']['value']}%'"
				. " OR CONCAT(pessoa.nome, ' ', pessoa.sobrenome) LIKE '%{$busca['search']['value']}%'"
			);
		}

		// if(isset($busca['order'][0])){
		// 	$this->query->orderBy("{$datatable['select'][$busca['order'][0]['column']]} {$busca['order'][0]['dir']}") .= " ORDER BY ";
		// }

		// debug2($busca);

		// if(isset($busca['start']) && isset($busca['length'])){
		// 	$this->query->limitFrom("{$busca['start']}, {$busca['length']}, {$busca['order'][0]['dir']}");
		// }

		return $this->query->fetchArray();
	}

	public function load_cadastro($id){
		return $this->query->select('
				pessoa.*,
				usuario.*
			')
			->from('pessoa pessoa')
			->leftJoin('usuario usuario ON usuario.id = pessoa.id_usuario AND usuario.ativo = 1')
			->where("pessoa.ativo = 1 AND pessoa.id = {$id}")
			->fetchArray();
	}

	public function buscar_orientador($busca){
		$this->query->select('
				usuario.id,
				usuario.email,
				pessoa.nome,
				pessoa.sobrenome,
				pessoa.link,
				orientador.id,
			')
			->from('pessoa pessoa')
			->leftJoin('usuario usuario ON usuario.id = pessoa.id_usuario AND pessoa.ativo = 1')
			->leftJoin('orientador orientador ON orientador.id_usuario = usuario.id AND orientador.ativo = 1')
			->where("CONCAT(pessoa.nome, ' ', pessoa.sobrenome) LIKE '%{$busca['nome']}%'")
			->andWhere('pessoa.ativo = 1');

		if(isset($busca['page_limit'])){
			$this->query->limitFrom($busca['page_limit'], 1);
		}

		return $this->query->fetchArray();
	}


}
