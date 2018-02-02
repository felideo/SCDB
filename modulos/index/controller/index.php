<?php
namespace Controller;

class Index extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'index',
		'name'		=> 'Index',
		'send'		=> 'Index'
	];

	public function index(){
		$this->view->render('front/cabecalho_rodape', $this->modulo['modulo'] . '/view/index/index');
	}
}