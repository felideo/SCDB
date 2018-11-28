<?php
namespace Controller;

use Libs;
use Libs\URL;

class Trabalho extends \Framework\ControllerCrud {

// hellcal insight

	protected $modulo = [
		'modulo' 	=> 'trabalho'
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo <i class="fa fa-search"></i>', 'Ano <i class="fa fa-search"></i>', 'Curso <i class="fa fa-search"></i>', 'Campi <i class="fa fa-search"></i>', 'Autor <i class="fa fa-search"></i>', 'Orientador <i class="fa fa-search"></i>', 'Status', 'Ações'],
		'ordenacao_desabilitada' => '5, 6, 8'
	];

	public function carregar_listagem_ajax(){
		$busca = [
			'order'  => carregar_variavel('order'),
			'search' => carregar_variavel('search'),
			'start'  => carregar_variavel('start'),
			'length' => carregar_variavel('length'),
		];

		$query = $this->model->carregar_listagem($busca);
        $botao = new \Libs\GerarBotoes();

		foreach($query as $indice => $item){
			$autores      = '';
			$orientadores = '';

			foreach($item['trabalho_relaciona_autor'] as $indice_01 => $autor){
				$autores .= $autor['pessoa'][0]['nome'] . ' ' . $autor['pessoa'][0]['sobrenome'] . '; ';
			}

			foreach($item['trabalho_relaciona_orientador'] as $indice_02 => $orientador){
				$orientadores .= $orientador['pessoa'][0]['pronome'] . ' ' . $orientador['pessoa'][0]['nome'] . ' ' . $orientador['pessoa'][0]['sobrenome'] . '; ';
			}

			$autores = rtrim($autores, '; ');
			$orientadores = rtrim($orientadores, '; ');

            $botao->setTitle('Aprovar Trabalho')
                ->setPermissao($this->permicao_apovar_reprovar_trebalho($item, 'aprovar'))
                ->setHref("/{$this->modulo['modulo']}/aprovar_reprovar/{$item['id']}/1")
                ->setTexto("<i class='botao_listagem fa fa-check-circle fa-fw'></i>")
                ->gerarBotao();

            $botao->setTitle('Reprovar Trabalho')
                ->setPermissao($this->permicao_apovar_reprovar_trebalho($item, 'reprovar'))
                ->setHref("/{$this->modulo['modulo']}/aprovar_reprovar/{$item['id']}/2")
                ->setTexto("<i class='botao_listagem fa fa-times-circle fa-fw'></i>")
                ->gerarBotao();

			if($item['status'] == 0){
				$status = 'Pendente';
			}elseif($item['status'] == 1){
				$status = 'Aprovado';
			}elseif($item['status'] == 2){
				$status = 'Reprovado';
			}

			$retorno[] = [
				$item['id'],
				$item['titulo'],
				$item['ano'],
				$item['curso'][0]['curso'],
				$item['campus'][0]['campus'],
				$autores,
				$orientadores,
				isset($status) && !empty($status) ? $status : '',

				$this->view->default_buttons_listagem($item['id'], true, true, true) . $botao->getBotoes()
			];
		}

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->select("SELECT count(id) AS total FROM {$this->modulo['modulo']} WHERE ativo = 1")[0]['total']),
            "data"            => $retorno
        ]);

		exit;
	}

	public function insert_update($trabalho, $where = null){
		$trabalho['trabalho']['id_curso']  = $this->tratar_curso($trabalho['trabalho']['id_curso']);
		$trabalho['trabalho']['id_campus'] = $this->tratar_campus($trabalho['trabalho']['id_campus']);
		$trabalho_db                       = $trabalho['trabalho'];
		$trabalho_db['titulo']             = strtoupper($trabalho_db['titulo']);

		$retorno_trabalho = $this->model->insert_update(
			'trabalho',
			$where,
			$trabalho_db,
			true
		);

		if(empty($retorno_trabalho['status'])){
			return ['status' => false];
		}

		$trabalho['trabalho']['id'] = $retorno_trabalho['id'];
		$trabalho_db['id']          = $retorno_trabalho['id'];
		$blame                      = empty($where) ? 'Cadastro' : 'Edição';

		$this->blame($trabalho['trabalho']['id'], $blame);

		$retorno_url = (new URL)->setId($retorno_trabalho['id'])
			->setUrl($trabalho_db['titulo'])
			->setController($this->modulo['modulo'])
			->setMetodo('visualizar_front')
			->cadastrarUrlAmigavel();

		$trabalho['orientador']     = $this->cadastrar_orientador($trabalho['orientador'], $retorno_trabalho['id']);
		$trabalho['autor']          = $this->cadastrar_autor($trabalho['autor'], $retorno_trabalho['id']);
		$trabalho['palavras_chave'] = $this->cadastrar_palavra_chave($trabalho['palavras_chave'], $retorno_trabalho['id']);

		$this->cadastrar_relacao_trabalho_arquivo($trabalho['arquivo'], $retorno_trabalho['id']);
		$this->indexar_trabalho_elasticsearch($trabalho);

		return $retorno_trabalho;
	}

	private function tratar_curso($curso){
		if(is_numeric($curso)){
			return $curso;
		}

		$insert_update_db = [
			'curso' => $curso,
			'localizador' => \Libs\Strings::limpezaCompleta($curso)
		];

		$retorno = $this->model->insert_update(
			'curso',
			['localizador' => \Libs\Strings::limpezaCompleta($curso)],
			$insert_update_db,
			false
		);

		if(!empty($retorno['status'])){
			return $retorno['id'];
		}

		$this->view->warn_js('Ocorreu um erro ao cadastrar o curso. Por favor edite o trabalho para corrigir.', 'erro');
	}

	private function tratar_campus($campus){
		if(is_numeric($campus)){
			return $campus;
		}

		$insert_update_db = [
			'campus' => $campus,
			'localizador' => \Libs\Strings::limpezaCompleta($campus)
		];

		$retorno = $this->model->insert_update(
			'campus',
			['localizador' => \Libs\Strings::limpezaCompleta($campus)],
			$insert_update_db,
			false
		);

		if(!empty($retorno['status'])){
			return $retorno['id'];
		}

		$this->view->warn_js('Ocorreu um erro ao cadastrar o campus. Por favor edite o trabalho para corrigir', 'erro');
	}

	public function blame($id_trabalho, $operacao){
		$insert_db = [
			'id_usuario'  => $_SESSION['usuario']['id'],
			'data'        => date("Y-m-d H:i:s"),
			'id_trabalho' => $id_trabalho,
			'operacao'    => $operacao
		];

		$retorno = $this->model->insert('blame_cadastro_trabalho', $insert_db);
	}

	private function cadastrar_orientador($orientadores, $id_trabalho){
		$this->model->execute("DELETE from trabalho_relaciona_orientador WHERE id_trabalho = {$id_trabalho}");

		$controller_orientador = $this->get_controller('orientador');
		$retorno_orientadores  = [];

		foreach($orientadores as $indice => $orientador){
			if(is_numeric($orientador['orientador'])){
				$retorno_orientadores[$indice]['orientador'] = $orientador['orientador'];
				$this->cadrastrar_relacao_trabalho_orientador($orientador['orientador'], $id_trabalho);
				continue;
			}

			$insert_db = [
				'nome'  => $orientador['orientador'],
				'email' => $orientador['email'],
				'link'  => $orientador['site'],
				'pronome' => !isset($orientador['pronome']) || empty($orientador['pronome']) ? '' : $orientador['pronome']
			];

			$retorno = $controller_orientador->insert_update($insert_db, []);

			if(!empty($retorno['status'])){
				$retorno_orientadores[$indice]['orientador'] = $retorno['pessoa']['retorno']['id'];

				$this->cadrastrar_relacao_trabalho_orientador($retorno['pessoa']['retorno']['id'], $id_trabalho);
				continue;
			}

			$this->view->warn_js('Ocorreu um erro ao cadastrar o orientador. Por favor edite o trabalho para corrigir', 'erro');
		}

		return $retorno_orientadores;
	}

	private function cadrastrar_relacao_trabalho_orientador($id_orientador, $id_trabalho){
		$insert_db = [
			'id_trabalho' => $id_trabalho,
			'id_pessoa'   => $id_orientador
		];

		$retorno = $this->model->insert_update(
			'trabalho_relaciona_orientador',
			['id_trabalho' => $id_trabalho, 'id_pessoa' => $id_orientador],
			$insert_db,
			true
		);

		if(empty($retorno['status'])){
			$this->view->warn_js('Ocorreu um erro ao relacionar um orientador ao trabalho. Por favor edite o trabalho para corrigir', 'erro');
		}
	}

	private function cadastrar_autor($autores, $id_trabalho){
		$this->model->execute("DELETE from trabalho_relaciona_autor WHERE id_trabalho = {$id_trabalho}");

		$controller_autor = $this->get_controller('autor');
		$retorno_autores  = [];

		foreach($autores as $indice => $autor){
			if(is_numeric($autor['autor'])){
				$retorno_autores[$indice]['autor'] = $autor['autor'];
				$this->cadrastrar_relacao_trabalho_autor($autor['autor'], $id_trabalho);
				continue;
			}

			$insert_db = [
				'nome'  => $autor['autor'],
				'email' => $autor['email'],
				'link'  => $autor['site'],
			];

			$retorno = $controller_autor->insert_update($insert_db, []);

			if(!empty($retorno['status'])){
				$retorno_autores[$indice]['autor'] = $retorno['pessoa']['retorno']['id'];

				$this->cadrastrar_relacao_trabalho_autor($retorno['pessoa']['retorno']['id'], $id_trabalho);
				continue;
			}

			$this->view->warn_js('Ocorreu um erro ao cadastrar o autor. Por favor edite o trabalho para corrigir', 'erro');
		}

		return $retorno_autores;
	}

	private function cadrastrar_relacao_trabalho_autor($id_autor, $id_trabalho){
		$insert_db = [
			'id_trabalho' => $id_trabalho,
			'id_pessoa'    => $id_autor
		];

		$retorno = $this->model->insert_update(
			'trabalho_relaciona_autor',
			['id_trabalho' => $id_trabalho, 'id_pessoa' => $id_autor],
			$insert_db,
			true
		);

		if(empty($retorno['status'])){
			$this->view->warn_js('Ocorreu um erro ao relacionar um autor ao trabalho. Por favor edite o trabalho para corrigir', 'erro');
		}
	}

	private function cadastrar_palavra_chave($palavras_chave, $id_trabalho){
		$palavras_chave = explode(',', $palavras_chave);

		$this->model->execute("DELETE from trabalho_relaciona_palavra_chave WHERE id_trabalho = {$id_trabalho}");

		$palavras_chave_ids = [];

		foreach($palavras_chave as $indice => $palavra){
			if(is_numeric($palavra)){
				$palavras_chave_ids[] = $palavra;

				$this->cadrastrar_relacao_trabalho_palavra_chave($palavra, $id_trabalho);
				continue;
			}

			$insert_update_db = [
				'palavra_chave' => $palavra,
				'localizador' => \Libs\Strings::limpezaCompleta($palavra)
			];

			$retorno = $this->model->insert_update(
				'palavra_chave',
				['localizador' => \Libs\Strings::limpezaCompleta($palavra)],
				$insert_update_db,
				false
			);

			if(!empty($retorno['status'])){
				$palavras_chave_ids[] = $retorno['id'];

				$this->cadrastrar_relacao_trabalho_palavra_chave($retorno['id'], $id_trabalho);
				continue;
			}

			$this->view->warn_js('Ocorreu um erro ao cadastrar a palvra-chave. Por favor edite o trabalho para corrigir', 'erro');
		}

		$retorno = implode(',', $palavras_chave_ids);

		return $retorno;
	}

	private function cadrastrar_relacao_trabalho_palavra_chave($palavra_chave, $id_trabalho){
		$insert_db = [
			'id_trabalho'      => $id_trabalho,
			'id_palavra_chave' => $palavra_chave
		];

		$retorno = $this->model->insert_update(
			'trabalho_relaciona_palavra_chave',
			['id_trabalho' => $id_trabalho, 'id_palavra_chave' => $palavra_chave],
			$insert_db,
			true
		);

		if(empty($retorno['status'])){
			$this->view->warn_js('Ocorreu um erro ao relacionar a palavra-chave ao trabalho. Por favor edite o trabalho para corrigir', 'erro');
		}
	}

	private function cadastrar_relacao_trabalho_arquivo($arquivos, $id_trabalho){
		$this->model->execute("DELETE from trabalho_relaciona_arquivo WHERE id_trabalho = {$id_trabalho}");

		foreach($arquivos as $indice => $arquivo){
			if(!is_numeric($arquivo)){
				$this->view->warn_js('Ocorreu um erro ao relacionar o arquivo ao trabalho. Por favor edite o trabalho para corrigir', 'erro');
				continue;
			}

			$insert_db = [
				'id_trabalho' => $id_trabalho,
				'id_arquivo'  => $arquivo
			];

			$retorno = $this->model->insert_update(
				'trabalho_relaciona_arquivo',
				['id_trabalho' => $id_trabalho, 'id_arquivo' => $arquivo],
				$insert_db,
				true
			);

			if(empty($retorno['status'])){
				$this->view->warn_js('Ocorreu um erro ao relacionar o arquivo ao trabalho. Por favor edite o trabalho para corrigir', 'erro');
			}
		}
	}

	private function indexar_trabalho_elasticsearch($trabalho){
		$elastic_search = new \Libs\ElasticSearch\ElasticSearch();

		debug2($trabalho);

		$trabalho['palavras_chave'] = $this->model->query
		 	->select('palavra_chave.palavra_chave')
		 	->from('palavra_chave palavra_chave')
		 	->whereIn('palavra_chave.id IN (' . $trabalho['palavras_chave'] . ')')
		 	->fetchArray();

		foreach($trabalho['palavras_chave'] as $indice => $palavra){
			$tmp[] = $palavra['palavra_chave'];
		}

		$trabalho['palavras_chave'] = implode(', ', $tmp);
		unset($tmp);

		foreach($trabalho['autor'] as $indice => $autor){
			$tmp[] = $autor['autor'];
		}

		$trabalho['autor'] = $this->model->query
		 	->select('autor.nome, autor.sobrenome')
		 	->from('pessoa autor')
		 	->whereIn('autor.id IN (' . implode(',', $tmp) . ')')
		 	->fetchArray();

		unset($tmp);

		foreach($trabalho['autor'] as $indice => $autor){
			$tmp[] = trim(preg_replace('/\s+/', ' ', $autor['nome'] . ' ' . $autor['sobrenome']));
		}

		$trabalho['autor'] = implode(', ', $tmp);
		unset($tmp);

		foreach($trabalho['orientador'] as $indice => $orientador){
			$tmp[] = $orientador['orientador'];
		}

		$trabalho['orientador'] = $this->model->query
		 	->select('orientador.pronome, orientador.nome, orientador.sobrenome')
		 	->from('pessoa orientador')
		 	->whereIn('orientador.id IN (' . implode(',', $tmp) . ')')
		 	->fetchArray();

		unset($tmp);

		foreach($trabalho['orientador'] as $indice => $orientador){
			$tmp[] = trim(preg_replace('/\s+/', ' ', $orientador['pronome'] . ' ' . $orientador['nome'] . ' ' . $orientador['sobrenome']));
		}

		$trabalho['orientador'] = implode(', ', $tmp);

		$tmp = array_values($trabalho['arquivo']);

		$trabalho['arquivo'] = $this->model->select("SELECT * FROM arquivo WHERE id = {$tmp[0]}");

		$this->model->select("SELECT * FROM arquivo WHERE id = {$tmp[0]}");

		$params = [
		    'index' => 'swdb',
		    'type'  => 'trabalho',
		    'id'    => $trabalho['trabalho']['id'],
		    'body'  => [
		    	'doc' => [
			    	'titulo'     => $trabalho['trabalho']['titulo'],
			    	'ano'        => $trabalho['trabalho']['ano'],
			    	'resumo'     => $trabalho['trabalho']['resumo'],
			    	'ativo'      => true,
					'curso'         => $trabalho['trabalho']['id_curso'],
					'campus'        => $trabalho['trabalho']['id_campus'],
					'palavra_chave' => $trabalho['palavras_chave'],
					'autor'         => $trabalho['autor'],
					'orientador'    => $trabalho['orientador'],
					// 'idioma'        => 'Portugues - PT-BR',
					'status'        => $this->model->select("SELECT status from trabalho WHERE id = {$trabalho['trabalho']['id']}")[0]['status'],
					// 'arquivo'    => base64_encode(file_get_contents(\Libs\Dominio::getDominio() . '/' . $trabalho['arquivo'][0]['endereco']))
				]
			]
		];

		$arquivo  = $elastic_search->indexar_documento(\Libs\Dominio::getDominio() . '/' . $trabalho['arquivo'][0]['endereco'], $trabalho['trabalho']['id']);
		$response = $elastic_search->indexar($params);

		debug2($arquivo);
		debug2($response);
		exit;
	}

	public function middle_visualizar($id){
		$blame = $this->model->carregar_blame($id[0]);

		foreach ($blame as &$culpado){
			switch ($culpado['operacao']) {
				case 'Cadastro':
					$culpado['cor_tag'] = 'label label-success';
					break;

				case 'Edição':
					$culpado['cor_tag'] = 'label label-high';
					break;

				case 'Exclusão':
					$culpado['cor_tag'] = 'label label-critical';
					break;

				case 'Aprovação':
					$culpado['cor_tag'] = 'label label-normal';
					break;

				case 'Reprovação':
					$culpado['cor_tag'] = 'label label-low';
					break;
			}
		}

		$trabalho = $this->model->carregar_trabalho($id[0])[0];

		$permissao_aprovar_reprovar = [
			'aprovar'  => $this->permicao_apovar_reprovar_trebalho($trabalho, 'aprovar'),
			'reprovar' => $this->permicao_apovar_reprovar_trebalho($trabalho, 'reprovar'),
		];

		$this->view->assign('cadastro', $trabalho);
		$this->view->assign('permissao_aprovar_reprovar', $permissao_aprovar_reprovar);
		$this->view->assign('blame', $blame);
	}

	public function middle_editar($id){
		$trabalho = $this->model->carregar_trabalho($id[0])[0];

		$permissao_aprovar_reprovar = [
			'aprovar'  => $this->permicao_apovar_reprovar_trebalho($trabalho, 'aprovar'),
			'reprovar' => $this->permicao_apovar_reprovar_trebalho($trabalho, 'reprovar'),
		];

		$this->view->assign('cadastro', $trabalho);
		$this->view->assign('permissao_aprovar_reprovar', $permissao_aprovar_reprovar);

	}

	public function middle_delete($id) {

		$retorno = $this->model->delete($this->modulo['modulo'], ['id' => $id[0]]);
		$this->blame($id[0], 'Exclusão');

		return $retorno;
	}

	private function permicao_apovar_reprovar_trebalho($trabalho, $acao){
		if(empty(\Util\Permission::check_user_permission($this->modulo['modulo'], $acao))){
			return false;
		}

		$orientadores = [];

		foreach($trabalho['trabalho_relaciona_orientador'] as $indice => $orientador){
			if(!isset($orientador['pessoa'][0]['id_usuario']) || empty($orientador['pessoa'][0]['id_usuario'])){
				continue;
			}

			$orientadores[] = $orientador['pessoa'][0]['id_usuario'];
		}

		if(empty($orientadores)){
			return false;
		}

		if($_SESSION['configuracoes']['politica_aprovacao'] == 3 && in_array($_SESSION['usuario']['id'], $orientadores)){
			return false;
		}

		if($_SESSION['configuracoes']['politica_aprovacao'] == 2 && !in_array($_SESSION['usuario']['id'], $orientadores)){
			return false;
		}

		switch($acao){
			case 'aprovar':
				if($trabalho['status'] == 0 || $trabalho['status'] == 2){
					return true;
				}
				break;

			case 'reprovar':
				if($trabalho['status'] == 0 || $trabalho['status'] == 1){
					return true;
				}
				break;
		}
	}

	public function aprovar_reprovar($parametros){
		$retorno = $this->model->update(
			'trabalho',
			['status' => $parametros[1]],
			['id' => $parametros[0]]
		);

		switch ($parametros[1]) {
			case 1:
				$blame           = 'Aprovação';
				$retorno_sucesso = 'Trabalho aprovado com sucesso!!!';
				$retorno_erro    = 'Ocorreu um erro ao aprovar o trabalho, por favor tente novamente...';
				break;

			case 2:
				$blame           = 'Reprovação';
				$retorno_sucesso = 'Trabalho reprovado com sucesso!!!';
				$retorno_erro    = 'Ocorreu um erro ao reprovar o trabalho, por favor tente novamente...';
				break;
		}

		$this->blame($parametros[0], $blame);


		if($retorno['status']){
			$this->atualizar_status_trabalho_elasticsearch($parametros[0], ['status' => $parametros[1]]);
			$this->view->alert_js($retorno_sucesso, 'sucesso');
		} else {
			$this->view->alert_js($retorno_erro, 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function atualizar_status_trabalho_elasticsearch($id, $parametros){
		$elastic_search = new \Libs\ElasticSearch\ElasticSearch();
		$params = [
		    'index' => 'swdb',
		    'type'  => 'trabalho',
		    'id'    => $id,
		    'body'  => [
		    	'doc' => [
				]
			]
		];

		foreach($parametros as $indice => $item){
			$params['body']['doc'][$indice] = $item;
		}

		$response = $elastic_search->indexar($params);
	}














	public function visualizar_front($id){
		$this->check_if_exists($id[0]);

		$front_controller = $this->get_controller('front');

		$this->view->assign('paginas_institucionais', $front_controller->carregar_cabecalho_rodape());

		$this->get_controller('contador')->contar('visita');

		$cadastro = $this->model->carregar_trabalho($id[0])[0];

		$this->view->assign('cadastro', $cadastro);
		$this->view->render('front/cabecalho_rodape', $this->modulo['modulo'] . '/view/front/front');
	}
}