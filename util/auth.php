<?php
namespace Util;

class Auth {
	public static function handLeLoggin() {
		$url = \Util\URL::modulo_url($_GET['url']);

		if(!isset($_SESSION) || empty($_SESSION['logado'])){
			header('location: ' . Redirect::getUrl());
			exit;
		}
	}
}