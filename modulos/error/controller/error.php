<?php
namespace Controller;

class Error extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'error',
		'name'		=> 'Error',
		'send'		=> 'Errors'
	];

	function __construct() {
		parent::__construct();
	}

	public function index() {
<<<<<<< HEAD
<<<<<<< HEAD:controllers/error/error.php
		$this->view->msg = 'Esta página não existe';
		$this->view->render($this->modulo['modulo'] . '/' . $this->modulo['modulo']);
=======
		$this->view->render('back/cabecalho_rodape', $this->modulo['modulo'] . '/view/error/' . $this->modulo['modulo']);
>>>>>>> 262262a... DEV - FELIDEOMVC * reorganização de arquivos na nova estrutura * remoção de porcarias!:modulos/error/controller/error.php
=======
		$this->view->render('back/cabecalho_rodape', $this->modulo['modulo'] . '/view/error/error');
>>>>>>> d895410... DEV - SWDB * ajuste final em todos os modulos na nova estrutura * incremento na abstração do carregamento do datatable!
	}
}