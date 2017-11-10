<?php
namespace Controller;

class Index extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'index',
		'name'		=> 'Index',
		'send'		=> 'Index'
	];

	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->imagens = $this->model->carregar_imagens_aleatorias();
		$this->view->render('front/cabecalho_rodape', $this->modulo['modulo'] . '/view/index/' . $this->modulo['modulo']);
	}

	public function print_sessao(){
		debug2($_SESSION);
		exit;
	}
}