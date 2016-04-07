<?php
namespace Controllers;

use Libs;

/**

*
*/
class Dashboard extends \Libs\Controller {



	function __construct() {

		parent::__construct();
		\Util\Auth::handLeLoggin();
		\Util\Permission::check();
	}

	function index() {
		$this->view->render('dashboard');
	}

	function logout() {

		\Libs\Session::destroy();
		header('location: '. URL .'login');
		exit;
	}


	function xhrInsert() {
		$this->model->xhrInsert();
	}

	function xhrGetListings() {
		$this->model->xhrGetListings();
	}

	function xhrDeleteListing() {

		$this->model->xhrDeleteListing();
	}

}

// como chamar esse cu
// 		require 'libs/Master.php';
// 		$lerolero = new Libs\Master;
// 		$lerolero->logout();
// 		debug2($lerolero);