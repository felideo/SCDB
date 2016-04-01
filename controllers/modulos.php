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
		$this->view->render('modulos');
	}
}