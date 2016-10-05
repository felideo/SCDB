<?php
namespace Models;

use Libs;

/**
*
*/
class Login_Model extends \Libs\Model {

	function __construct() {
		parent::__construct();
	}

	function run() {
		$sth = $this->db->prepare("SELECT * FROM usuario WHERE
			email = :email AND senha = :senha");

		$sth->execute(array(
			':email' => $_POST['email'],
			// ':senha' => \Libs\Hash::create('sha256', $_POST['senha'], HASH_PASSWORD_KEY)
			':senha' => $_POST['senha']
		));

		$data = $sth->fetch();


		$count = $sth->rowCount();
		$modulos = $this->db->select('SELECT * FROM modulo WHERE ATIVO = 1 ORDER BY ordem');


		foreach ($modulos as $indice => $modulo) {
			$menus[!empty($modulo['submenu']) ? $modulo['submenu'] : $modulo['nome']][] = $modulo;
		}

		foreach ($modulos as $indice => $modulo) {
			$modulos[$modulo['modulo']] = $modulo;
			unset($modulos[$indice]);
		}

		if($count > 0) {

			$user = [
				'id' => $data['id'],
				'nome' => $data['email'],
				'hierarquia' => $data['hierarquia'],

			];

			// login
			\Libs\Session::init();
			\Libs\Session::set('logado', true);
			\Libs\Session::set('usuario', $user);
			\Libs\Session::set('modulos', $modulos);
			\Libs\Session::set('menus', $menus);

			header('location: ../painel_controle');
		} else {
			header('location: ../login');
		}
	}
}