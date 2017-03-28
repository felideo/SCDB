<?php
namespace Controllers;

use Libs;

class organismo extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'organismo',
		'name'		=> 'Organismo',
		'send'		=> 'Organismo'
	];

	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->render('front/cabecalho_rodape' ,'front/organismo/cadastro_organismo/cadastro_organismo');
	}

	public function cadastro(){
		$this->view->action = '/create';
		$this->view->render('front/cabecalho_rodape' ,'front/organismo/cadastro_organismo/cadastro_organismo');
	}

	public function create(){
		// debug2($_POST);


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
		$this->create_trabalho($trabalhos, $retorno_organismo);


		if($retorno_organismo['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' cadastrado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	private function create_trabalho($trabalhos, $retorno_organismo){
		foreach ($trabalhos as $indice => $trabalho) {
			if(!is_numeric($trabalho['autor'])){
				$insert_db_autor = [
					'autor' => $trabalho['autor'],
					'site'  => $trabalho['site'],
					'email' => $trabalho['email']
				];

				$retorno_autor = $this->model->get_insert('autor', $insert_db_autor);
			}else{
				$retorno_autor['id'] = $trabalho['autor'];
			}

			if(!is_numeric($trabalho['idioma'])){
				$insert_db_idioma = [
					'idioma' => $trabalho['idioma']
				];

				$retorno_idioma = $this->model->get_insert('idioma', $insert_db_idioma);
			}else{
				$retorno_idioma['id'] = $trabalho['idioma'];
			}

			$insert_db_trabalho = [
				'link_trabalho' => $trabalho['link_trabalho'],
				'titulo'        => $trabalho['titulo'],
				'ano'           => $trabalho['ano'],
				'resumo'        => $trabalho['resumo']
			];

			$retorno_trabalho = $this->model->get_insert('trabalho', $insert_db_trabalho);

			$palavras_chave = explode(',', $trabalho['palavras_chave']);

			foreach ($palavras_chave as $indice => $palavra_chave) {

				if(is_numeric($palavra_chave)){
					$insert_db_relacao_palavra_chave = [
						'id_trabalho'      => $retorno_trabalho['id'],
						'id_palavra_chave' => $palavra_chave
					];

					$this->model->get_insert('trabalho_relaciona_palavra_chave', $insert_db_relacao_palavra_chave);

					continue;
				}

				$insert_db_palavra_chave = [
					'palavra_chave' => $palavra_chave,
				];

				$retorno_palavra_chave = $this->model->get_insert('palavra_chave', $insert_db_palavra_chave);

				$insert_db_relacao_palavra_chave = [
					'id_trabalho'      => $retorno_trabalho['id'],
					'id_palavra_chave' => $retorno_palavra_chave['id']
				];

				$this->model->get_insert('trabalho_relaciona_palavra_chave', $insert_db_relacao_palavra_chave);
			}

			$retorno_ralacao_organismo_trabalho_autor = [
				`id_organismo` => $retorno_organismo['id'],
				`id_trabalho`  => $retorno_trabalho['id'],
				`id_autor`     => $retorno_autor['id'],
			];
		}
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
		foreach ($posicoes_geograficas as $indice => $posicao_geografica) {
			$insert_db = [
				'latitude'     => $posicao_geografica['latitude'],
				'longitude'    => $posicao_geografica['longitude'],
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