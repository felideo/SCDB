<?php
namespace Controller;

use Libs;

class Painel_Controle extends \Framework\Controller {

	private $modulo = [
		'modulo' 	=> 'painel_controle',
		'name'		=> 'Painel de Controle',
		'send'		=> 'Painel de Controle'
	];

	public function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->assign('modulo', $this->modulo);
	}

	public function index() {
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/painel_controle');
	}
}