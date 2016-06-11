<?php
namespace Controllers;

use Libs;

/**
*
*/
class Lerolero extends \Libs\Controller
{

	function __construct() {
		echo "maria";
		exit;
		parent::__construct();
	}

	public function index()
	{
		// echo \Libs\Hash::create('sha256', 'gui', HASH_PASSWORD_KEY);
		$this->view->render('lerolero');

	}

}