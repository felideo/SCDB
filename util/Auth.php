<?php
namespace Util;

/**
*
*/

class Auth {

	public static function handLeLoggin() {
		@session_start();
		if(isset($_SESSION['loggedIn'])){
			$logged = $_SESSION['loggedIn'];
		} else {
			$logged = false;
		}


		// $logged = $_SESSION['loggedIn'];
		// if(!isset($logged) || $logged == false) {
		// 	session_destroy();
		//
		// 	exit;
		// }

	}
}