<?php
namespace Libs;

/**
*	classe View
*/
class View {

	function __construct() {}

	public function render($name, $noInclude = false) {
		if($noInclude == true){
			require 'views/' . $name . '.php';
		} else {
			require 'views/render/render/header.php';
			require 'views/' . $name . '/' . $name . '.php';
			require 'views/render/render/footer.php';
		}
	}

	public function clean_render($name) {
		require 'views/render/clean_render/header.php';
		require 'views/' . $name . '/' . $name . '.php';
		require 'views/render/clean_render/footer.php';
	}

	public function sub_render($name, $name_2 = null) {
		if(!is_null($name_2)){
			require 'views/render/render/header.php';
			require 'views/' . $name . '/' . $name_2 . '.php';
			require 'views/render/render/footer.php';
		} else {
		 	require 'views/render/render/header.php';
			require 'views/' . $name . '/' . $name . '.php';
			require 'views/render/render/footer.php';
		}
	}
}