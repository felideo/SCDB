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
		$lerolero = $this->model->load_full_list('modulos');
		// debug2($lerolero);
		$this->view->render('modulos');
	}
}