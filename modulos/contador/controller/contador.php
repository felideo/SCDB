<?php
namespace Controller;

use Libs;

class Contador extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'contador',
		'name'		=> 'Contador',
		'send'		=> 'Contador'
	];

	public function contar($acao, $contar_usuario = false){
		$insert_db['acao'] = $acao;

		if(!empty($contar_usuario)){
			$insert_db['id_usuario'] = $_SESSION['usuario']['id'];
		}



		$this->model->insert($this->modulo['modulo'], $insert_db);
	}
}
