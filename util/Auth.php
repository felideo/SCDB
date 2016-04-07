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
		}

	}
}