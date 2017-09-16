<?php
namespace Controllers;

use Libs;



class organismo extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'organismo',
		'name'		=> 'Organismo',
		'send'		=> 'Organismo'
	];

	protected $colunas = ['ID', 'Nome Binominal', 'Nomes Populares', 'Ações'];

	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index(){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable($this->colunas);

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/listagem/listagem');


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

		$retorno = [];

		foreach ($query as $indice => $item) {

			$nomes_populares = [];

			foreach ($item['organismo_relaciona_nome_popular'] as $indice => $nome_popular) {


				if(isset($nome_popular['nome_popular'][0]['nome'])){
					$nomes_populares[] = $nome_popular['nome_popular'][0]['nome'];
				}
			}

			$retorno[] = [
				$item['id'],
				$item['nome'] . ' ' . $item['taxon'][0]['taxon'][0]['nome'],
				!empty($nomes_populares) ? implode(', ', $nomes_populares) : '',
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];

			unset($nomes_populares);
		}

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->db->select("SELECT count(id) AS total FROM {$this->modulo['modulo']} WHERE ativo = 1")[0]['total']),
            "data"            => $retorno
        ]);

		exit;
	}

	// public function index() {

	// 	$this->view->render('front/cabecalho_rodape' ,'front/organismo/cadastro_organismo/cadastro_organismo');
	// }

	public function visualizacao($id){
		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /index');
			exit;
		}

		$organismo = $this->model->carregar_organismo($id[0]);

		$this->view->organismo = $organismo;
		$this->view->render('front/cabecalho_rodape' ,'front/organismo/visualizacao_organismo/visualizacao_organismo', true);
	}

	public function visualizar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");
		$this->check_if_exists($id[0]);

		$this->view->organismo = $this->model->carregar_organismo($id[0]);

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form', true);

	}

	public function cadastro(){
		$this->view->action = '/create';
		$this->view->render('front/cabecalho_rodape' ,'front/organismo/cadastro_organismo/cadastro_organismo');
	}

	public function create(){
		$taxonomia            = carregar_variavel('taxonomia');
		$detalhes             = carregar_variavel('detalhes');
		$nomes_populares      = carregar_variavel('nomes_populares');
		$posicoes_geograficas = carregar_variavel('posicao_geografica');
		$imagens              = carregar_variavel('imagens');
		$trabalhos            = carregar_variavel('trabalho');

		$retorno_taxonomia    = $this->create_taxon($taxonomia);
		$retorno_organismo    = $this->create_organismo($retorno_taxonomia, $detalhes);
		$this->create_nome_popular($nomes_populares, $retorno_organismo);
		$this->create_imagem_relacao($imagens, $retorno_organismo);
		$this->create_posicao_geografica($posicoes_geograficas, $retorno_organismo);
		$retorno_trabalho_autor = $this->create_trabalho($trabalhos, $retorno_organismo);
		$this->create_relacao_organismo_trabalho_autor($retorno_trabalho_autor, $retorno_organismo);


		// ZZZ: insert relação organismo, trabalho, autor;

		if($retorno_organismo['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' cadastrado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}


	private function create_relacao_organismo_trabalho_autor($retorno_trabalho_autor){
		foreach ($retorno_trabalho_autor as $indice => $trabalho) {
			unset($trabalho['id_autor']);
			$retorno_relacao = $this->model->get_insert('organismo_relaciona_trabalho', $trabalho);
		}
	}


	private function create_trabalho($trabalhos, $retorno_organismo){
		$retorno_organismo_trabalho_autor = [];
		foreach ($trabalhos as $indice_01 => $trabalho) {

			$retorno_organismo_trabalho_autor[$indice_01]['id_organismo'] = $retorno_organismo['id'];

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

			$retorno_organismo_trabalho_autor[$indice_01]['id_autor'] = $retorno_autor['id'];

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
				$insert_db_trabalho = [
					'ano'           => $trabalho['ano'],
					'id_autor'      => $retorno_autor['id'],
					'link_trabalho' => $trabalho['link_trabalho'],
					'titulo'        => $trabalho['titulo'],
					'resumo'        => $trabalho['resumo'],
					'id_idioma'        => $retorno_idioma['id'],
				];

				$retorno_trabalho = $this->model->get_insert('trabalho', $insert_db_trabalho);
			}elseif(isset($trabalho['id_arquivo']) && !empty($trabalho['id_arquivo'])){
				$insert_db_trabalho = [
					'ano'        => $trabalho['ano'],
					'id_autor'   => $retorno_autor['id'],
					'id_arquivo' => $trabalho['id_arquivo'],
					'titulo'     => $trabalho['titulo'],
					'resumo'     => $trabalho['resumo'],
					'id_idioma'     => $retorno_idioma['id'],
				];

				$retorno_trabalho = $this->model->get_insert('trabalho', $insert_db_trabalho);
			}else{
				$insert_db_trabalho = [
					'ano'       => $trabalho['ano'],
					'id_autor'  => $retorno_autor['id'],
					'titulo'    => $trabalho['titulo'],
					'resumo'    => $trabalho['resumo'],
					'id_idioma' => $retorno_idioma['id'],
				];

				$retorno_trabalho = $this->model->get_insert('trabalho', $insert_db_trabalho);

			}

			$retorno_organismo_trabalho_autor[$indice_01]['id_trabalho'] = $retorno_trabalho['id'];

			$palavras_chave = explode(',', $trabalho['palavras_chave']);

			foreach ($palavras_chave as $indice_02 => $palavra_chave) {

				if(is_numeric($palavra_chave)){
					$insert_db_relacao_palavra_chave = [
						'id_trabalho'      => $retorno_trabalho['id'],
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
					'id_trabalho'      => $retorno_trabalho['id'],
					'id_palavra_chave' => $retorno_palavra_chave['id']
				];

				$this->model->get_insert('trabalho_relaciona_palavra_chave', $insert_db_relacao_palavra_chave);
			}

		}

		return $retorno_organismo_trabalho_autor;
	}

	private function create_imagem_relacao($imagens, $retorno_organismo){
		if(empty($imagens)){
			return false;
		}

		foreach ($imagens as $indice => $imagem) {
			$insert_db = [
				'id_arquivo'   => $imagem,
				'id_organismo' => $retorno_organismo['id']
			];

			$this->model->get_insert('organismo_relaciona_imagem', $insert_db);
		}

	}

	private function create_posicao_geografica($posicoes_geograficas, $retorno_organismo){

		if(!isset($posicoes_geograficas) || empty($posicoes_geograficas)){
			return false;
		}

		foreach ($posicoes_geograficas as $indice => $posicao_geografica) {
			$insert_db = [
				'latitude'     => (float) $posicao_geografica['latitude'],
				'longitude'    => (float) $posicao_geografica['longitude'],
				'id_organismo' => $retorno_organismo['id']
			];

			$this->model->get_insert('posicao_geografica', $insert_db);
		}
	}

	private function create_taxon($classificacao_taxonomica){
		// $this->tratar_taxons($classificacao_taxonomica);
		$organismo = '';

		foreach ($classificacao_taxonomica as $indice => $taxon) {
			if(is_numeric($taxon) || empty($taxon)){
				$organismo .= $taxon . '-';
			}elseif(is_string($taxon)){

				$verificar_duplicidade = $this->model->db->select("SELECT id, nome FROM taxon WHERE nome = '{$taxon}' AND ativo = 1");
				if(!empty($verificar_duplicidade)){
					$organismo .= $verificar_duplicidade[0]['id'] . '-';
					$classificacao_taxonomica[$indice] = $verificar_duplicidade[0]['id'];
					unset($verificar_duplicidade);
					continue;
				}

				$insert_db = [
					'nome'             => $taxon,
					'id_classificacao' => $indice,
					'id_taxon'         => $classificacao_taxonomica[$indice - 1]
				];

				$retorno_insert_taxon = $this->model->get_insert('taxon', $insert_db);


				if($retorno_insert_taxon['status'] == 1){
					$organismo .= $retorno_insert_taxon['id'] . '-';
					$classificacao_taxonomica[$indice] = $retorno_insert_taxon['id'];
				}else{

				}
			}
		}

		if(strpos($organismo, '--')){
			$organismo = str_replace('--', '', $organismo);
		}else{
			$organismo = substr($organismo, 0, -1);
		}

		$organismo = '-' . $organismo . '-';

		$retorno = [
			'id_last_taxon' => !empty($classificacao_taxonomica[8]) ? $classificacao_taxonomica[8] : $classificacao_taxonomica[7],
			'localizador'   => $organismo,
			'nome'          => !empty($classificacao_taxonomica[8])
				? $this->model->db->select("SELECT nome FROM taxon WHERE id = {$classificacao_taxonomica[8]} AND ativo = 1 LIMIT 1")[0]['nome']
				: $this->model->db->select("SELECT nome FROM taxon WHERE id = {$classificacao_taxonomica[7]} AND ativo = 1 LIMIT 1")[0]['nome']
		];

		return $retorno;
	}

	private function tratar_taxons(&$classificacao_taxonomica){

		foreach ($classificacao_taxonomica as $indice => $taxon) {
			if(is_numeric($taxon)){
				continue;
			}

			$taxon = rtrim(ltrim($taxon));
			$classificacao_taxonomica[$indice] = rtrim(ltrim($taxon));

			if($indice != 7 || $indice != 8){
				$classificacao_taxonomica[$indice] = ucwords($taxon);
			}

			if($indice == 7){

				debug2(strpos($taxon, strtolower($classificacao_taxonomica[$indice - 1])));

				if(is_numeric(strpos($taxon, strtolower(remover_acentos($classificacao_taxonomica[$indice - 1]))))){
					$especie = rtrim(ltrim(strtolower(str_replace(strtolower($classificacao_taxonomica[$indice - 1]), '', $taxon))));
					$classificacao_taxonomica[$indice] = $classificacao_taxonomica[$indice - 1] . ' ' . $especie;
				}else{
					$classificacao_taxonomica[$indice] = strtolower($taxon);
				}

			}elseif($indice = 8){

				if(strpos($taxon, $classificacao_taxonomica[$indice - 1])){
					$taxon = str_replace($classificacao_taxonomica[$indice - 1], '', $taxon);
				}

				if(strpos($taxon, $classificacao_taxonomica[$indice - 2])){
					$taxon = str_replace($classificacao_taxonomica[$indice - 2], '', $taxon);
				}


				$classificacao_taxonomica[$indice] = rtrim(ltrim(strtolower($taxon)));
			}
		}
	}

	private function create_organismo($retorno_taxonomia, $detalhes){

		$verificar_duplicidade = $this->model->db->select("SELECT id, nome FROM organismo WHERE localizador = '{$retorno_taxonomia['localizador']}' AND ativo = 1");

		if(!empty($verificar_duplicidade)){
			return [
				'status'     => 1,
				'id'         => $verificar_duplicidade[0]['id'],
				'error_code' => null,
				'erros_info' => null,
			];
		}

		$insert_db = [
			'nome'          => $retorno_taxonomia['nome'],
			'localizador'   => $retorno_taxonomia['localizador'],
			'id_last_taxon' => $retorno_taxonomia['id_last_taxon']
		];

		$insert_db = array_merge($insert_db, $detalhes);

		return $this->model->get_insert('organismo', $insert_db);
	}

	private function create_nome_popular($nomes_populares, $retorno_organismo){
		$nomes_populares = explode(',', $nomes_populares);

		foreach ($nomes_populares as $indice => $nome_popular) {

			if(is_numeric($nome_popular) || empty($nome_popular)){
				$insert_db = [
					'id_organismo'    => $retorno_organismo['id'],
					'id_nome_popular' => $nome_popular
				];

				$this->model->get_insert('organismo_relaciona_nome_popular', $insert_db);

				continue;
			}

			$verificar_duplicidade = $this->model->db->select("SELECT id, nome FROM nome_popular WHERE nome = '{$nome_popular}' AND ativo = 1");

			if(!empty($verificar_duplicidade)){
				$insert_db = [
					'id_organismo'    => $retorno_organismo['id'],
					'id_nome_popular' => $verificar_duplicidade[0]['id']
				];

				$this->model->get_insert('organismo_relaciona_nome_popular', $insert_db);

				continue;
			}

			$insert_db = [
				'nome'         => $nome_popular,
			];

			$retorno_nome_popular = $this->model->get_insert('nome_popular', $insert_db);

			unset($insert_db);

			$insert_db = [
				'id_organismo'    => $retorno_organismo['id'],
				'id_nome_popular' => $retorno_nome_popular['id']
			];

			$this->model->get_insert('organismo_relaciona_nome_popular', $insert_db);

			unset($insert_db);
		}
	}

	public function buscar_nome_popular_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_nome_popular($busca);

		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			$add_cadastro[0] = [
				'id'               => $busca['nome'],
				'nome'             => "<strong>Cadastrar Novo Taxon: </strong>" . $busca['nome']
			];

			$retorno = array_merge($add_cadastro, $retorno);
		}

		echo json_encode($retorno);
		exit;
	}


}