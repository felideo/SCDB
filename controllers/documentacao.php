<?php
namespace Controllers;

use Libs;

/**
*
*/
class Documentacao extends \Libs\Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index() {
		// echo \Libs\Hash::create('sha256', 'gui', HASH_PASSWORD_KEY);
		$this->view->clean_render('documentacao');
	}

}