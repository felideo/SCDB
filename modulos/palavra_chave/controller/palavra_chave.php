<?php
namespace Controller;

use Libs;

class Palavra_chave extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'autor',
		'name'		=> 'Autores',
		'send'		=> 'Autor'
	];

<<<<<<< HEAD
	function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Email', 'Hierarquia', 'Ações']);
		$this->listagem($this->model->load_active_list($this->modulo['modulo']));

		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/listagem/listagem');
	}
=======
	protected $colunas = ['ID', 'palavra_chave', 'Ações'];

	protected $datatable = [
		'colunas' => ['ID', 'Palavra Chave', 'Ações'],
		'select'  => ['id', 'palavra_chave'],
		'from'    => 'palavra_chave',
		'search'  => ['id', 'palavra_chave']
	];
>>>>>>> d895410... DEV - SWDB * ajuste final em todos os modulos na nova estrutura * incremento na abstração do carregamento do datatable!

	public function create(){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$insert_db = carregar_variavel('usuario');

		$insert_db += [
			"senha" => \Util\Hash::get_unic_hash()
		];

<<<<<<< HEAD
		$retorno = $this->model->create('usuario', $insert_db);
=======
		$query = $this->model->carregar_listagem($busca, $this->datatable);
>>>>>>> d895410... DEV - SWDB * ajuste final em todos os modulos na nova estrutura * incremento na abstração do carregamento do datatable!


		if($retorno['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	private function listagem($dados_linha){
		if(empty($dados_linha)){
			return false;
		}

		foreach ($this->model->load_active_list('hierarquia') as $indice => $hierarquia) {
			$hierarquias[$hierarquia['id']] = $hierarquia['nome'];
		};

		foreach ($dados_linha as $indice => $linha) {
			if($linha['super_admin'] != 1){

				$hierarquia_exibicao = isset($hierarquias[$linha['hierarquia']]) ? $hierarquias[$linha['hierarquia']] : 'Usuario Site' ;

				$retorno_linhas[] = [
					"<td class='sorting_1'>{$linha['id']}</td>",
	        		"<td>{$linha['email']}</td>",
	        		"<td>{$hierarquia_exibicao}</td>",
	        		"<td>" . $this->view->default_buttons_listagem($linha['id']) . "</td>"
				];
			}
		}

		if(!isset($retorno_linhas)){
			return false;
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/editar/editar');

	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro = $this->model->full_load_by_id('usuario', $id[0])[0];
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/usuario/editar/editar');
		$this->view->lazy_view();
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$update_db = carregar_variavel('usuario');

		if(empty($update_db['senha'])){
			unset($update_db['senha']);
		}

		$retorno = $this->model->update('usuario', $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		if($_SESSION['usuario']['id'] == $id[0]){
			$this->view->alert_js('Você não pode excluir seu proprio usuário!!!', 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$retorno = $this->model->delete('usuario', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function verificar_duplicidade_ajax(){
		echo json_encode(empty($this->model->load_user_by_email(carregar_variavel('usuario'))));
		exit;
	}

	public function perfil(){
		$this->view->render('front/cabecalho_rodape', 'front/usuario/perfil');
	}










	public function buscar_palavra_chave_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_palavra_chave($busca);

<<<<<<< HEAD
		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			$add_cadastro[0] = [
				'id'               => $busca['nome'],
				'palavra'             => "<strong>Cadastrar Nova Palavra Chave: </strong>" . $busca['nome']
=======

		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			if(empty($retorno)){
				$retorno = [];
			}

			$add_cadastro[0] = [
				'id'            => $busca['nome'],
				'palavra_chave' => "<strong>Cadastrar Nova Palavra Chave: </strong>" . $busca['nome']
>>>>>>> d895410... DEV - SWDB * ajuste final em todos os modulos na nova estrutura * incremento na abstração do carregamento do datatable!
			];

			$retorno = array_merge($add_cadastro, $retorno);
		}

		echo json_encode($retorno);
		exit;
	}













}