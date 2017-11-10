<?php
namespace Controllers;

use Libs;

class busca extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'busca',
		'name'		=> 'Busca',
		'send'		=> 'Buscar'
	];

	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
		$this->view->front_render('front/busca/busca');
	}

	public function buscar_taxonomia_select2(){
		$busca = carregar_variavel('busca');

		echo json_encode($this->model->buscar_taxonomia($busca));
		exit;
	}

	public function buscar_hierarquia_ajax(){
		$busca = carregar_variavel('id_clado');

		echo json_encode($this->model->buscar_hierarquia($busca));
		exit;
	}


}