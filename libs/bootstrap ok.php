<?php
namespace Libs;

/**
* classe Bootstrap
*/
class bootstrap {
	function __construct() {
		$url = $this->get_url();

		if(empty($url[0])) {
			require 'controllers/index/index.php';
			$controller = new \Controllers\Index();
			$controller->loadModel('index');
			$controller->index();
			return false;
		}

		$arquivo_metodo = $this->identificar_arquivo_metodo($url);

		debug2($arquivo_metodo);

		if(file_exists($arquivo_metodo['arquivo'])) {
			require $arquivo_metodo['arquivo'];
		} else {
			// $this->error();
			// exit();
		}

		$instancia_controller = '\\controllers\\' . $arquivo_metodo['classe'];
		$controller = new $instancia_controller;

		if(!empty($arquivo_metodo['classe'])){
			$controller->loadModel($arquivo_metodo['classe']);
		}

		if(method_exists($controller, $arquivo_metodo['metodo'])) {
			$controller->{$arquivo_metodo['metodo']}();
		} else {
			$controller->index();
		}
	}

	private function get_url(){
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		return $url;
	}

	private function identificar_arquivo_metodo($url){
		$file = 'controllers/';
		$method = 0;

		foreach ($url as $indice => $value) {
			$file .= $value . '/';

			if($indice == (count($url) - 1)) {
				$file .= $url[$indice] . ".php";
			}

			if(!file_exists($file)){
				$class = $indice - 1;
				$method = $indice;
			} else {
				$class = $indice;
				$method = NULL;
			}
		}

		if(!empty($method)){
			$file = str_replace(
				$url[$method] . '/' . $url[$method] . '.php',
				$url[($method - 1)], $file
			) . '.php';
		}

		return [
			'arquivo' 	=> $file,
			'classe' 	=> $url[$class],
			'metodo' 	=> isset($method) ? $url[$method] : null

		];
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