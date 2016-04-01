<?php
namespace Util;
use Libs;
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
			// debug2(URL);
			// header('location: http://hidrosis.localhost/login');
		}

	}
}