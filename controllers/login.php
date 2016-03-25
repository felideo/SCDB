<?php
namespace Controllers;

use Libs;

/**

*
*/
class Login extends \Libs\Controller
{



	function __construct() {
		parent::__construct();
	}

	function index() {


		// $lerolero = \Libs\Session::get('loggedIn');
		// if(\Libs\Session::get('loggedIn') == true){
		// debug2($lerolero);

		// if(\Libs\Session::get('loggedIn') == true){
			$this->view->clean_render('login');
		// } else {
			// header('Location: /dashboard');
		// }
	}

	function run() {

		$this->model->run();
	}
}