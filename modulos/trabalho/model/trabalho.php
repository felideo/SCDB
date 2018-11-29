<?php
namespace Model;

use Libs;

class trabalho extends \Framework\Model{
	public function carregar_listagem($busca, $datatable = null){
		$this->query->select('
			trabalho.titulo,
			trabalho.ano,
			trabalho.status,
			campus.campus,
			curso.curso,
			rel_autor.id,
			autor.nome,
			autor.sobrenome,
			rel_orientador.id,
			orientador.pronome,
			orientador.nome,
			orientador.sobrenome,
			orientador.id_usuario,
		')
		->from('trabalho trabalho')
		->leftJoin('campus campus ON campus.id = trabalho.id_campus AND campus.ativo = 1')
		->leftJoin('curso curso ON curso.id = trabalho.id_curso AND curso.ativo = 1')
		->leftJoin('trabalho_relaciona_autor rel_autor ON rel_autor.id_trabalho = trabalho.id AND rel_autor.ativo = 1')
		->leftJoin('pessoa autor ON autor.id = rel_autor.id_pessoa AND autor.ativo = 1')
		->leftJoin('trabalho_relaciona_orientador rel_orientador ON rel_orientador.id_trabalho = trabalho.id and rel_orientador.ativo = 1')
		->leftJoin('pessoa orientador ON orientador.id = rel_orientador.id_pessoa AND orientador.ativo = 1')
		->where('trabalho.ativo = 1');

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$this->query->andWhere("
				trabalho.id LIKE '%{$busca['search']['value']}%'
				OR trabalho.titulo LIKE '%{$busca['search']['value']}%'
				OR campus.campus LIKE '%{$busca['search']['value']}%'
				OR curso.curso LIKE '%{$busca['search']['value']}%'
				OR autor.nome LIKE '%{$busca['search']['value']}%'
				OR orientador.nome LIKE '%{$busca['search']['value']}%'
				OR trabalho.ano LIKE '%{$busca['search']['value']}%'

			", 'AND');
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$this->query->limit($busca['length']);
			$this->query->offset($busca['start']);
		}

		if(isset($busca['order'][0]) && !empty($busca['order'][0])){
			switch($busca['order'][0]['column']){
				case '0':
					$this->query->orderBy("trabalho.id {$busca['order'][0]['dir']}");
					break;

				case '1':
					$this->query->orderBy("trabalho.titulo {$busca['order'][0]['dir']}");
					break;

				case '2':
					$this->query->orderBy("trabalho.ano {$busca['order'][0]['dir']}");
					break;

				case '3':
					$this->query->orderBy("curso.curso {$busca['order'][0]['dir']}");
					break;

				case '4':
					$this->query->orderBy("campus.campus {$busca['order'][0]['dir']}");
					break;

				case '7':
					$this->query->orderBy("trabalho.status {$busca['order'][0]['dir']}");
					break;

				default:
					$this->query->orderBy("trabalho.id {$busca['order'][0]['dir']}");
					break;
			}
		}

		$retorno = $this->query->fetchArray();
		return $retorno;
	}

	public function carregar_blame($id_trabalho){
		return $this->query
			->select('
				blame.*,
				usuario.email,
				pessoa.nome,
				pessoa.sobrenome,
			')
			->from('blame_cadastro_trabalho blame')
			->leftJoin('usuario usuario ON usuario.id = blame.id_usuario')
			->leftJoin('pessoa pessoa ON pessoa.id_usuario = usuario.id ')
			->where("blame.id_trabalho = {$id_trabalho}")
			->orderBy('blame.data ASC')
			->fetchArray();

	}

	public function carregar_resultado_busca($trabalhos){
		$this->query->select('
			trabalho.titulo,
			trabalho.ano,
			trabalho.resumo,
			trabalho.status,
			curso.curso,
			rel_autor.id,
			rel_palavra.id,
			autor.nome,
			autor.sobrenome,
			url.url,
			url.controller,
			palavra.palavra_chave,
			rel_arquivo.id,
			arquivo.endereco
		')
		->from('trabalho trabalho')
		->leftJoin('curso curso ON curso.id = trabalho.id_curso and curso.ativo = 1')
		->leftJoin('trabalho_relaciona_autor rel_autor ON rel_autor.id_trabalho = trabalho.id and rel_autor.ativo = 1')
		->leftJoin('pessoa autor ON autor.id = rel_autor.id_pessoa AND autor.ativo = 1')
		->leftJoin('trabalho_relaciona_palavra_chave rel_palavra ON rel_palavra.id_trabalho = trabalho.id and rel_palavra.ativo = 1')
		->leftJoin('palavra_chave palavra ON palavra.id = rel_palavra.id_palavra_chave and palavra.ativo = 1')
		->leftJoin('url url ON url.id_controller = trabalho.id AND url.controller = "trabalho" AND url.metodo = "visualizar_front" AND url.ativo = 1')
		->leftJoin('trabalho_relaciona_arquivo rel_arquivo ON rel_arquivo.id_trabalho = trabalho.id AND rel_arquivo.ativo = 1')
		->leftJoin('arquivo arquivo ON arquivo.id = rel_arquivo.id_arquivo_thumb AND arquivo.ativo = 1')

		->where('trabalho.id IN (' . implode(',', $trabalhos) . ')')
		->andWhere('trabalho.ativo = 1 AND trabalho.status = 1');

		return $this->query->fetchArray();
	}

	public function carregar_trabalho($id){
		$this->query->select('
				trabalho.titulo,
				trabalho.ano,
				trabalho.resumo,
				trabalho.status,
				campus.campus,
				curso.curso,
				rel_autor.id,
				rel_orientador.id,
				rel_trabalho.id,
				rel_trabalho.id_arquivo_thumb,
				rel_palavra.id,
				autor.nome,
				autor.sobrenome,

				autor.link,
				autor_user.email,
				orientador.nome,
				orientador.sobrenome,
				orientador.pronome,
				orientador.link,
				orientador_user.email,
				orientador.id_usuario,
				arquivo.hash,
				arquivo.nome,
				arquivo.endereco,
				arquivo.tamanho,
				arquivo.extensao,
				palavra.palavra_chave
			')

			->from('trabalho trabalho')
			->leftJoin('campus campus ON campus.id = trabalho.id_campus and campus.ativo = 1')
			->leftJoin('curso curso ON curso.id = trabalho.id_curso and curso.ativo = 1')
			->leftJoin('trabalho_relaciona_autor rel_autor ON rel_autor.id_trabalho = trabalho.id and rel_autor.ativo = 1')
			->leftJoin('trabalho_relaciona_orientador rel_orientador ON rel_orientador.id_trabalho = trabalho.id and rel_orientador.ativo = 1')
			->leftJoin('pessoa autor ON autor.id = rel_autor.id_pessoa AND autor.ativo = 1')
			->leftJoin('usuario autor_user ON autor_user.id = autor.id_usuario AND autor_user.ativo = 1')
			->leftJoin('pessoa orientador ON orientador.id = rel_orientador.id_pessoa AND orientador.ativo = 1')
			->leftJoin('usuario orientador_user ON orientador_user.id = orientador.id_usuario AND orientador_user.ativo = 1')

			->leftJoin('trabalho_relaciona_arquivo rel_trabalho ON rel_trabalho.id_trabalho = trabalho.id and rel_trabalho.ativo = 1')
			->leftJoin('arquivo arquivo ON arquivo.id = rel_trabalho.id_arquivo AND arquivo.ativo = 1')

			->leftJoin('trabalho_relaciona_palavra_chave rel_palavra ON rel_palavra.id_trabalho = trabalho.id and rel_palavra.ativo = 1')
			->leftJoin('palavra_chave palavra ON palavra.id = rel_palavra.id_palavra_chave and palavra.ativo = 1')
			->where("trabalho.id = {$id}");

		$retorno = $this->query->fetchArray();

		if(!isset($retorno[0]['trabalho_relaciona_arquivo'][0]['id_arquivo_thumb']) || empty($retorno[0]['trabalho_relaciona_arquivo'][0]['id_arquivo_thumb'])){
			return $retorno;
		}

		$retorno[0]['trabalho_relaciona_arquivo'][0]['thumb'] = $this->query->select('
				arquivo.hash,
				arquivo.nome,
				arquivo.endereco,
				arquivo.tamanho,
				arquivo.extensao,
			')
			->from('arquivo arquivo')
			->where('arquivo.id = ' . $retorno[0]['trabalho_relaciona_arquivo'][0]['id_arquivo_thumb'])
			->andWhere('arquivo.ativo = 1')
			->fetchArray();

		return $retorno;
	}
}


