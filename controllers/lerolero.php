<?php
namespace Controllers;

use Libs;

/**
*
*/
class Lerolero extends \Libs\Controller
{

<<<<<<< Updated upstream
	function __construct()
	{
=======
	function __construct() {
>>>>>>> Stashed changes
		echo "maria";
		exit;
		parent::__construct();
	}

	public function index()
	{
		// echo \Libs\Hash::create('sha256', 'gui', HASH_PASSWORD_KEY);
<<<<<<< Updated upstream
		$this->view->render('index/index');
=======
		$this->view->render('lerolero');
>>>>>>> Stashed changes
	}

}