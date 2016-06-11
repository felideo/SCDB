<?php
namespace Libs;

/**
* classe Bootstrap
*/
class Bootstrap {
	function __construct() {

		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		if(empty($url[0])) {
			require 'controllers/index/index.php';
			$controller = new \Controllers\Index();
			$controller->loadModel('index');
			$controller->index();
			return false;
		}

		$file = 'controllers/';
		$method = 0;

		foreach ($url as $indice => $value) {
			$file .= $value . '/';

			if($indice == (count($url) - 1)) {
				$file .= $url[$indice] . ".php";
				$remove = '\\' . $url[$indice] . ".php";
			}

			if( !file_exists($file)){
				$method = $indice;
			}
		}

		if(!empty($method)){
			$file = str_replace(
				$url[$method] . '/' . $url[$method] . '.php',
				$url[($method - 1)], $file
			) . '.php';
		}

		$view = str_replace("controllers/", 'views/', $file);
		$view = str_replace(".php", '', $file);

		if(file_exists($file)) {
			require $file;
		} else {
			$this->error();
			exit();
		}

		$instancia_controller = '\\Controllers\\' . $url[0];
		// str_replace($remove, '', $file);
		$controller = new $instancia_controller;

		if(!empty($url[($method - 1)])){
			$controller->loadModel($url[($method - 1)]);
		} else {
			$controller->loadModel($url[($method)]);
		}

		if(method_exists($controller, $url[$method])) {
			$controller->{$url[$method]}();
		} else {
			$controller->index();
		}
	}

	/**
	 * método Error
	 * É chamado quando um controlador ou seu método ñ existir
	 */
	public function error() {
		require 'controllers/error/error.php';
		$controller = new \Controllers\Error();
		$controller->index();
		return false;
	}

}