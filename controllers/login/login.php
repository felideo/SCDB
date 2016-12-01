<?php
namespace Controllers;

use Libs;

class Login extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'login',
		'name'		=> 'Login',
		'send'		=> 'Login'
	];

	function __construct() {
		// \Util\Auth::handLeLoggin();
		parent::__construct();

		$this->view->modulo = $this->modulo;
	}

	function index() {
		$this->view->clean_render('/login/login');
	}

	function run() {
		$retorno = $this->model->run();

		if($retorno == true){
			header('location: ../painel_controle');
		}else{
			$this->view->alert_js('Usúario ou Senha inválido...', 'erro');
			header('location: ../login');
		}
	}


}