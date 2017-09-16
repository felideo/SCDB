<?php
namespace Controllers;

use Libs;

class Trabalho extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'trabalho',
		'name'		=> 'Trabalhos',
		'send'		=> 'trabalho'
	];

	protected $colunas = ['ID', 'Titulo', 'Autor', 'Palavras Chave', 'Ações'];

	function __construct() {
		parent::__construct();
	}

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
				$retorno_tratado[$retorno['id']]['palavra_chave'] .= ', ' . $retorno['palavra_chave'];
			}
		}

		$retorno = [];

		foreach ($retorno_tratado as $indice => $item) {

			$retorno[] = [
				$item['id'],
				$item['titulo'],
				$item['nome'],
				$item['palavra_chave'],


				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->db->select("SELECT count(id) AS total FROM {$this->modulo['modulo']} WHERE ativo = 1")[0]['total']),
            "data"            => $retorno
        ]);

		exit;
	}


	public function visualizar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");
		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->carregar_trabalho($id[0]);

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form', true);

	}

	public function editar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");
		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->carregar_trabalho($id[0]);

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form');
	}

	public function update($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->check_if_exists($id[0]);

		$trabalho = carregar_variavel($this->modulo['modulo']);
		// exit;

		$retorno_organismo_trabalho_autor['id_organismo'] = $trabalho['id_organismo'];


		$retorno_organismo_trabalho_autor = [];

		$trabalho['id'] = $id[0];

		if(!is_numeric($trabalho['autor'])){
			$verificar_duplicidade = $this->model->db->select("SELECT id, nome FROM autor WHERE nome = '{$trabalho['autor']}' AND ativo = 1");

			if(!empty($verificar_duplicidade)){
				$retorno_autor['id'] = $verificar_duplicidade[0]['id'];
				unset($verificar_duplicidade);
			}else{
				$insert_db_autor = [
					'nome' => $trabalho['autor'],
					'link'  => $trabalho['site'],
					'email' => $trabalho['email']
				];

				$retorno_autor = $this->model->get_insert('autor', $insert_db_autor);
			}

		}else{
			$retorno_autor['id'] = $trabalho['autor'];
		}



		$retorno_organismo_trabalho_autor['id_autor'] = $retorno_autor['id'];

		if(!is_numeric($trabalho['idioma'])){
			$verificar_duplicidade = $this->model->db->select("SELECT id, idioma FROM idioma WHERE idioma = '{$trabalho['idioma']}' AND ativo = 1");

			if(!empty($verificar_duplicidade)){
				$retorno_idioma['id'] = $verificar_duplicidade[0]['id'];
				unset($verificar_duplicidade);
			}else{
				$insert_db_idioma = [
					'idioma' => $trabalho['idioma']
				];

				$retorno_idioma = $this->model->get_insert('idioma', $insert_db_idioma);
			}
		}else{
			$retorno_idioma['id'] = $trabalho['idioma'];
		}



		if(isset($trabalho['link_trabalho']) && !empty($trabalho['link_trabalho'])){
			$update_db = [
				'ano'           => $trabalho['ano'],
				'id_autor'      => $retorno_autor['id'],
				'link_trabalho' => $trabalho['link_trabalho'],
				'titulo'        => $trabalho['titulo'],
				'resumo'        => $trabalho['resumo'],
				'id_idioma'     => $retorno_idioma['id'],
			];

		}elseif(isset($trabalho['id_arquivo']) && !empty($trabalho['id_arquivo'])){
			$update_db = [
				'ano'        => $trabalho['ano'],
				'id_autor'   => $retorno_autor['id'],
				'id_arquivo' => $trabalho['id_arquivo'],
				'titulo'     => $trabalho['titulo'],
				'resumo'     => $trabalho['resumo'],
				'id_idioma'     => $retorno_idioma['id'],
			];

		}else{
			$update_db = [
				'ano'       => $trabalho['ano'],
				'id_autor'  => $retorno_autor['id'],
				'titulo'    => $trabalho['titulo'],
				'resumo'    => $trabalho['resumo'],
				'id_idioma' => $retorno_idioma['id'],
			];


		}

		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);
		$retorno_organismo_trabalho_autor['id_trabalho'] = $id[0];
		$retorno_organismo_trabalho_autor['id_organismo'] = $trabalho['id_organismo'];

		$palavras_chave = explode(',', $trabalho['palavras_chave']);
		$this->model->update_relacao('trabalho_relaciona_palavra_chave', 'id_trabalho', $id[0], ['ativo' => 0]);

		foreach ($palavras_chave as $indice_02 => $palavra_chave) {

			if(is_numeric($palavra_chave)){
				$insert_db_relacao_palavra_chave = [
					'id_trabalho'      => $trabalho['id'],
					'id_palavra_chave' => $palavra_chave
				];

				$this->model->get_insert('trabalho_relaciona_palavra_chave', $insert_db_relacao_palavra_chave);
				continue;
			}else{
				$verificar_duplicidade = $this->model->db->select("SELECT id, palavra_chave FROM palavra_chave WHERE palavra_chave = '{$palavra_chave}' AND ativo = 1");

				if(!empty($verificar_duplicidade)){
					$retorno_palavra_chave['id'] = $verificar_duplicidade[0]['id'];
					unset($verificar_duplicidade);
				}else{
					$insert_db_palavra_chave = [
						'palavra_chave' => $palavra_chave,
					];

					$retorno_palavra_chave = $this->model->get_insert('palavra_chave', $insert_db_palavra_chave);
				}
			}

			$insert_db_relacao_palavra_chave = [
				'id_trabalho'      => $trabalho['id'],
				'id_palavra_chave' => $retorno_palavra_chave['id']
			];

			$this->model->get_insert('trabalho_relaciona_palavra_chave', $insert_db_relacao_palavra_chave);
		}


 		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

}