<?php
namespace Model;
use Libs;

class Autor extends \Framework\Model{

	public function carregar_listagem($busca, $datatable = null){
		$this->query->select('
				pessoa.pronome,
				pessoa.nome,
				pessoa.sobrenome,
				usuario.email,
			')
			->from('pessoa pessoa')
			->innerJoin('usuario usuario ON usuario.id = pessoa.id_usuario AND usuario.ativo = 1')
			->where('pessoa.ativo = 1 AND pessoa.autor = 1');

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$where = "pessoa.id LIKE '%{$busca['search']['value']}%'"
				. " OR usuario.email LIKE '%{$busca['search']['value']}%'"
				. " OR CONCAT('pessoa.nome', ' ', 'pessoa.sobrenome') LIKE '%{$busca['search']['value']}%'";

			$this->query->andWhere($where);
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$this->query->limit($busca['length']);
			$this->query->offset($busca['start']);
		}

		if(isset($busca['order'][0]) && !empty($busca['order'][0])){
			switch($busca['order'][0]['column']){
				case '0':
					$this->query->orderBy("pessoa.id {$busca['order'][0]['dir']}");
					break;

				case '2':
					$this->query->orderBy("CONCAT('pessoa.nome', ' ', 'pessoa.sobrenome') {$busca['order'][0]['dir']}");
					break;

				case '3':
					$this->query->orderBy("usuario.email {$busca['order'][0]['dir']}");
					break;

				default:
					$this->query->orderBy("usuario.id {$busca['order'][0]['dir']}");
					break;
			}
		}

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

	public function buscar_autor($busca){
		$this->query->select('
				pessoa.*
			')
			->from('pessoa pessoa')
			->where("CONCAT('pessoa.nome', ' ', 'pessoa.sobrenome') LIKE '%{$busca['nome']}%' AND pessoa.ativo = 1")
			->orWhere('pessoa.autor = 1 OR pessoa.orientador = 1');

			if(isset($busca['page_limit'])){
				$this->query->limit($busca['page_limit']);
			}

		return $this->query->fetchArray();
	}
}
