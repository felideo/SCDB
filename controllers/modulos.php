<?php
namespace Controllers;

use Libs;

/**
*
*/
class Modulos extends \Libs\Controller {

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();
	}

	function index() {
		$this->view->modulo_list = $this->model->load_full_list('modulos');
		$this->view->render('modulos');
	}
}