<?php
namespace Util;
use Libs;

class Permission {
	public static function check() {
		$url = URL::modulo_url($_SERVER['REQUEST_URI']);

		if(	!empty($_SESSION['modulos'][$url[1]]) &&
			!empty($_SESSION['usuario']) &&
		 	$_SESSION['modulos'][$url[1]]['hierarquia'] < $_SESSION['usuario']['hierarquia']){
				header('location: http://hidrosis.localhost/dashboard');
		}
	}
}