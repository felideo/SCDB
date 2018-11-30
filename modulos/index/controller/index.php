<?php
namespace Controller;

class Index extends \Framework\Controller {

	protected $modulo = [
		'modulo' 	=> 'index',
		'name'		=> 'Index',
		'send'		=> 'Index'
	];

	public function index(){
		$front_controller = $this->get_controller('front');
		$front_controller->carregar_cabecalho_rodape();
		$this->get_controller('contador')->contar('visita');

		// $this->view->render('front/cabecalho_rodape', $this->modulo['modulo'] . '/view/front/front');
		$this->view->render_plataforma('index');
	}
}