<?php
namespace Controllers;

use Libs;

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
		// $this->view->clean_render('/index/index');
		$this->view->render('front/cabecalho_rodape', 'front/index/index');
	}

	public function admin() {
		header('location: login/admin');
	}

}