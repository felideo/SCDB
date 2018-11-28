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
	];

	public function carregar_listagem_ajax(){
		$busca = [
			'order'  => carregar_variavel('order'),
			'search' => carregar_variavel('search'),
			'start'  => carregar_variavel('start'),
			'length' => carregar_variavel('length'),
		];

		$query = $this->model->carregar_listagem($busca);

		$retorno_tratado = [];

		foreach ($query as $indice => $retorno) {
			if(!isset($retorno_tratado[$retorno['id']])){
				$retorno_tratado[$retorno['id']] = $retorno;
			}else{
				$retorno_tratado[$retorno['id']]['palavra'] .= ', ' . $retorno['palavra'];
			}
		}

		$retorno = [];

		foreach ($retorno_tratado as $indice => $item) {
			$autor      = '';
			$orientador = '';

			foreach ($item['trabalho_relaciona_autor'] as $indice => $um_autor){
				$autor .= isset($um_autor['autor'][0]['nome']) ? $um_autor['autor'][0]['nome'] . ' ' : ' ';
			}

			foreach ($item['trabalho_relaciona_orientador'] as $indice => $um_orientador){
				$orientador .= isset($um_orientador['orientador'][0]['nome']) ? $um_orientador['orientador'][0]['nome'] . ' ' : ' ';
			}

			$botao_aprovar  = $this->permicao_apovar_reprovar_trebalho($item, 'aprovar');
			$botao_reprovar = $this->permicao_apovar_reprovar_trebalho($item, 'reprovar');

			$botao_aprovar = \Util\Permission::check_user_permission($this->modulo['modulo'], "aprovar") && ($item['status'] == 0 || $item['status'] == 2) ?
				"<a href='/{$this->modulo['modulo']}/aprovar/{$item['id']}' title='Visualizar'><i class='botao_listagem fa fa-check-circle fa-fw'></i></a>" :
				'';

			$botao_reprovar = \Util\Permission::check_user_permission($this->modulo['modulo'], "reprovar") && ($item['status'] == 0 || $item['status'] == 1) ?
					"<a href='/{$this->modulo['modulo']}/reprovar/{$item['id']}' title='Visualizar'><i class='botao_listagem fa fa-times-circle fa-fw'></i></a>" :
					'';

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
				isset($autor) && !empty($autor) ? $autor : '',
				isset($orientador) && !empty($orientador) ? $orientador : '',
				isset($status) && !empty($status) ? $status : '',

				$this->view->default_buttons_listagem($item['id'], true, true, true) . $botao_aprovar . $botao_reprovar
			];
		}

		ob_clean();

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->select("SELECT count(id) AS total FROM {$this->modulo['modulo']} WHERE ativo = 1")[0]['total']),
            "data"            => $retorno
        ]);

		exit;
	}

	public function insert_update($trabalho, $where = null){
		$trabalho_db                       = $trabalho['trabalho'];
		$trabalho_db['id_curso']           = $this->tratar_curso($trabalho_db['id_curso']);
		$trabalho_db['id_campus']          = $this->tratar_campus($trabalho_db['id_campus']);
		$trabalho_db['status']             = 0;
		$trabalho_db['titulo'] = strtoupper($trabalho_db['titulo']);

		$retorno_trabalho = $this->model->insert_update(
			'trabalho',
			$where,
			$trabalho_db,
			false
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

		$this->cadastrar_orientador($trabalho['orientador'], $retorno_trabalho['id']);
		$this->cadastrar_autor($trabalho['autor'], $retorno_trabalho['id']);
		$this->cadastrar_palavra_chave($trabalho['palavras_chave'], $retorno_trabalho['id']);
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

		foreach($orientadores as $indice => $orientador){
			if(is_numeric($orientador['orientador'])){
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
				$this->cadrastrar_relacao_trabalho_orientador($retorno['pessoa']['retorno']['id'], $id_trabalho);
				continue;
			}

			$this->view->warn_js('Ocorreu um erro ao cadastrar o orientador. Por favor edite o trabalho para corrigir', 'erro');
		}
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

		foreach($autores as $indice => $autor){
			if(is_numeric($autor['autor'])){
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
				$this->cadrastrar_relacao_trabalho_autor($retorno['pessoa']['retorno']['id'], $id_trabalho);
				continue;
			}

			$this->view->warn_js('Ocorreu um erro ao cadastrar o autor. Por favor edite o trabalho para corrigir', 'erro');
		}
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

		foreach($palavras_chave as $indice => $palavra){
			if(is_numeric($palavra)){
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
				$this->cadrastrar_relacao_trabalho_palavra_chave($retorno['id'], $id_trabalho);
				continue;
			}

			$this->view->warn_js('Ocorreu um erro ao cadastrar a palvra-chave. Por favor edite o trabalho para corrigir', 'erro');
		}
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
		// $elastic_search = new \Libs\ElasticSearch\ElasticSearch();

		// $trabalho['palavras_chave'] = $this->model->query
		//  	->select('palavra_chave.palavra_chave')
		//  	->from('palavra_chave palavra_chave')
		//  	->whereIn('palavra_chave.id IN (' . $trabalho['palavras_chave'] . ')')
		//  	->fetchArray();

		// foreach($trabalho['palavras_chave'] as $indice => $palavra){
		// 	$tmp[] = $palavra['palavra_chave'];
		// }

		// $trabalho['palavras_chave'] = implode(', ', $tmp);
		// unset($tmp);

		// foreach($trabalho['autor'] as $indice => $autor){
		// 	$tmp[] = $autor['autor'];
		// }

		// $trabalho['autor'] = $this->model->query
		//  	->select('autor.nome')
		//  	->from('autor autor')
		//  	->whereIn('autor.id IN (' . implode(',', $tmp) . ')')
		//  	->fetchArray();

		// unset($tmp);

		// foreach($trabalho['autor'] as $indice => $autor){
		// 	$tmp[] = $autor['nome'];
		// }

		// $trabalho['autor'] = implode(', ', $tmp);
		// unset($tmp);

		// foreach($trabalho['orientador'] as $indice => $orientador){
		// 	$tmp[] = $orientador['orientador'];
		// }

		// $trabalho['orientador'] = $this->model->query
		//  	->select('orientador.nome')
		//  	->from('orientador orientador')
		//  	->whereIn('orientador.id IN (' . implode(',', $tmp) . ')')
		//  	->fetchArray();

		// unset($tmp);

		// foreach($trabalho['orientador'] as $indice => $orientador){
		// 	$tmp[] = $orientador['nome'];
		// }

		// $trabalho['orientador'] = implode(', ', $tmp);

		// $tmp = array_values($trabalho['arquivo']);

		// $trabalho['arquivo'] = $this->model->select("SELECT * FROM arquivo WHERE id = {$tmp[0]}");

		// $this->model->select("SELECT * FROM arquivo WHERE id = {$tmp[0]}");

		// $params = [
		//     'index' => 'swdb',
		//     'type'  => 'trabalho',
		//     'id'    => $trabalho['trabalho']['id'],
		//     'body'  => [
		//     	'doc' => [
		// 	    	'titulo'     => $trabalho['trabalho']['titulo'],
		// 	    	'ano'        => $trabalho['trabalho']['ano'],
		// 	    	'resumo'     => $trabalho['trabalho']['resumo'],
		// 	    	'ativo'      => true,
		// 			'curso'         => $trabalho['trabalho']['id_curso'],
		// 			'campus'        => $trabalho['trabalho']['id_campus'],
		// 			'palavra_chave' => $trabalho['palavras_chave'],
		// 			'autor'         => $trabalho['autor'],
		// 			'orientador'    => $trabalho['orientador'],
		// 			// 'idioma'        => 'Portugues - PT-BR',
		// 			'status'        => 1,
		// 			// 'arquivo'    => base64_encode(file_get_contents(\Libs\Dominio::getDominio() . '/' . $trabalho['arquivo'][0]['endereco']))
		// 		]
		// 	]
		// ];

		// ob_clean();

		// debug2($params);
		// exit;


		// $arquivo  = $elastic_search->indexar_documento(\Libs\Dominio::getDominio() . '/' . $trabalho['arquivo'][0]['endereco'], $trabalho['trabalho']['id']);
		// $response = $elastic_search->indexar($params);

		// debug2($arquivo);
		// debug2($response);
		// exit;
	}

	public function middle_visualizar($id){
		$blame = $this->model->carregar_blame($id[0]);

		foreach ($blame as &$trabalho){
			switch ($trabalho['operacao']) {
				case 'Cadastro':
					$trabalho['cor_tag'] = 'label label-success';
					break;

				case 'Edição':
					$trabalho['cor_tag'] = 'label label-high';
					break;

				case 'Exclusão':
					$trabalho['cor_tag'] = 'label label-critical';
					break;

				case 'Aprovação':
					$trabalho['cor_tag'] = 'label label-normal';
					break;

				case 'Reprovação':
					$trabalho['cor_tag'] = 'label label-low';
					break;
			}
		}

		$this->view->assign('cadastro', $this->model->carregar_trabalho($id[0])[0]);
		$this->view->assign('blame', $blame);
	}

	public function middle_editar($id){

		$this->view->assign('cadastro', $this->model->carregar_trabalho($id[0])[0]);
	}

	public function middle_delete($id) {

		$retorno = $this->model->delete($this->modulo['modulo'], ['id' => $id[0]]);
		$this->blame($id[0], 'Exclusão');

		return $retorno;
	}



















	private function permicao_apovar_reprovar_trebalho($trabalho, $botao){
		switch ($_SESSION['configuracoes']['politica_aprovacao']) {
			case 1:
				$aprovar =  true;
				break;
			case 2:
				debug2($trabalho);

				$orientadores = [];

				foreach ($trabalho['trabalho_relaciona_orientador'] as $indice => $orientador){
					# code...
				}


				break;
			case 3:
				# code...
				break;

			default:
				$aprovar_reprovar = false;
				break;
		}

		switch ($botao) {
			case 'aprobar':
				return \Util\Permission::check_user_permission($this->modulo['modulo'], "aprovar") && ($item['status'] == 0 || $item['status'] == 2) ?
				"<a href='/{$this->modulo['modulo']}/aprovar/{$item['id']}' title='Visualizar'><i class='botao_listagem fa fa-check-circle fa-fw'></i></a>" :
				'';
				break;

			case 'reprovar':
				return \Util\Permission::check_user_permission($this->modulo['modulo'], "reprovar") && ($item['status'] == 0 || $item['status'] == 1) ?
					"<a href='/{$this->modulo['modulo']}/reprovar/{$item['id']}' title='Visualizar'><i class='botao_listagem fa fa-times-circle fa-fw'></i></a>" :
					'';
				break;
		}

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



	public function aprovar($parametros){
		$retorno_aprovar = $this->model->update('trabalho', ['status' => 1], ['id' => $parametros[0]]);

		$this->blame($parametros[0], 'Aprovação');


		if($retorno_aprovar['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' aprovado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao aprovar o ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function reprovar($parametros){
		$retorno_reprovar = $this->model->update('trabalho', ['status' => 2], ['id' => $parametros[0]]);

		$this->blame($parametros[0], 'Reprovação');

		if($retorno_reprovar['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' reprovado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao reprovar o ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}
}