<?php
namespace Controllers;

use Libs;

class Install extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'install',
		'name'		=> 'Install',
		'send'		=> 'Instalar'
	];

	function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->clean_render($this->modulo['modulo'] . '/install/install');
	}

	public function install() {
		$database = carregar_variavel('database');
		$user = carregar_variavel('user');
		$retorno = $this->model->create_database($database, $user);

		if(!empty($retorno['sucesso']) && $retorno['sucesso'] == true){
			$this->view->alert_js('Aplicação instalada com sucesso!!!', 'sucesso');
			header('location: ' . URL . 'login');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a instalação da aplicação, por favor tente novamente...', 'erro');
			header('location: ' . URL . 'install');
		}
	}
}