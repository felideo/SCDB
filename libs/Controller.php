<?php
namespace Libs;

/**
*
*/
abstract class Controller {
	protected $cu;

	function __construct() {
		$this->view = new View();
	}

	public function loadModel($name) {
		$path = 'models/' . $name . '_model.php';

		if(file_exists($path)) {
			require 'models/' . $name . '_model.php';

			$modelName = '\\Models\\' . $name . '_Model';
			$this->model = new $modelName;
		}
	}

	public function set_cu($twig){
		echo 'lerolero';
		$this->cu = $twig;
	}

	public function get_cu(){
		return $this->cu;
	}



	abstract public function index();
}