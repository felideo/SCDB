<?php
namespace Controller;

class Acesso extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'acesso',
		'name'		=> 'Acesso',
		'send'		=> 'Acesso'
	];

	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function login(){
		$this->view->render('front/cabecalho_rodape', 'front/acesso/login/login');
	}

	public function admin() {
		$this->view->render('back/cabecalho_rodape', $this->modulo['modulo'] . '/view/back/login');
	}

	public function cadastro(){
		$this->view->render('front/cabecalho_rodape', 'front/acesso/cadastro/cadastro');
	}

	public function run() {
		$retorno = $this->model->run(carregar_variavel('acesso'));

		if($retorno == true){
			$this->view->alert_js('Login efetuado com sucesso!', 'sucesso');
			header('location: ../index');
		}else{
			$this->view->alert_js('Usúario ou Senha inválido...', 'erro');
			header('location: ../login');
		}
	}

	public function run_back(){
		$retorno = $this->model->run_back(carregar_variavel('acesso'));

		if($retorno == true){
			header('location: ../painel_controle');
		}else{
			$this->view->alert_js('Usúario ou Senha inválido...', 'erro');
			header('location: ../login');
		}
	}

	public function usuario_create(){

		$usuario = carregar_variavel('usuario');

		$insert_db = [
			'email'      => $usuario['email'],
			'senha'      => $usuario['senha']
		];

		$retorno_usuario = $this->model->create('usuario', $insert_db);

		if($retorno_usuario['status'] == 1 && !empty($retorno_usuario['id'])){
			unset($insert_db);

			$insert_db = [
				'id_usuario'  => $retorno_usuario['id'],
				'pronome'     => $usuario['pronome'],
				'nome'        => $usuario['nome'],
				'sobrenome'   => $usuario['sobrenome'],
				'instituicao' => $usuario['instituicao']
			];

			$retorno_pessoa = $this->model->create('pessoa', $insert_db);
		}

		if($retorno_usuario['status'] == 1 && $retorno_pessoa['status'] == 1 && !empty($retorno_usuario) && !empty($retorno_pessoa)){
			$acesso = [
				'email' => $usuario['email'],
				'senha' =>	$usuario['senha']
			];

			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');

			$retorno = $this->model->run($acesso);
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /index');
	}
}

