<?php
namespace Framework;

abstract class Controller {
	function __construct() {
		\Libs\Session::init();
		$this->view = new View();
	}

	public function loadModel($model) {
		$path = strtolower("modulos/{$model}/model/{$model}.php");

		if(file_exists($path)) {
			require $path;

			$modelName = '\\Model\\' . ucfirst($model);
			$this->model = new $modelName;
		}else{
			$this->model = new GenericModel();
		}
	}

	public function load_external_model($name) {
		$path = 'modulos/' . $name . '/model/' .  $name . '.php';

		if(file_exists($path)) {
			require $path;

			$modelName = '\\Model\\' . ucfirst($name);
			return new $modelName;
		}
	}

	public function check_if_exists($id){
		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id} AND ativo = 1"))){
			$this->view->alert_js(ucfirst($this->modulo['send']) . ' não existe...', 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}
	}

	public function print_sessao(){
		debug2($_SESSION);
		exit;
	}

	public function limpar_sessao(){
		session_unset();
		session_destroy();
		debug2('Sessão limpa! \o/');
		exit;
	}

	public function set_sessao($parametros){
		$_SESSION[$parametros[0]] = $parametros[1];
		debug2('$_SESSION[' . $parametros[0] . '] = ' . $parametros[1]);
		exit;
	}
}