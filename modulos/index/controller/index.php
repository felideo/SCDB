<?php
namespace Controller;

class Index extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'index',
		'name'		=> 'Index',
		'send'		=> 'Index'
	];

<<<<<<< HEAD
	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
<<<<<<< HEAD:controllers/index/index.php
		$this->view->render('front/cabecalho_rodape', 'front/index/index');
	}

	public function admin() {
		header('location: login/admin');
	}

=======
		$this->view->imagens = $this->model->carregar_imagens_aleatorias();
		$this->view->render('front/cabecalho_rodape', $this->modulo['modulo'] . '/view/index/' . $this->modulo['modulo']);
	}

	public function print_sessao(){
		debug2($_SESSION);
		exit;
=======
	public function index(){
		$this->view->render('back/cabecalho_rodape', $this->modulo['modulo'] . '/view/index/index');
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
	}
>>>>>>> 262262a... DEV - FELIDEOMVC * reorganização de arquivos na nova estrutura * remoção de porcarias!:modulos/index/controller/index.php
}