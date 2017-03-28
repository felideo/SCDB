<?php
namespace Controllers;

use Libs;

class Login extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'login',
		'name'		=> 'Login',
		'send'		=> 'Login'
	];

	public function __construct() {
		// \Util\Auth::handLeLoggin();
		parent::__construct();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->render('front/cabecalho_rodape', 'front/acesso/login/login');
	}

	public function admin() {
		$this->view->render('back/cabecalho_rodape', 'back/login/login');
	}

	public function run() {
		$retorno = $this->model->run();

		if($retorno == true){
			header('location: ../painel_controle');
		}else{
			$this->view->alert_js('Usúario ou Senha inválido...', 'erro');
			header('location: ../login');
		}
	}


}