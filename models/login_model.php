<?php
namespace Models;

use Libs;

/**
*
*/
class Login_Model extends \Libs\Model {


	function __construct()
	{
		parent::__construct();
	}

	function run()
	{

		$sth = $this->db->prepare("SELECT * FROM user WHERE
			username = :username AND password = :password");



		$sth->execute(array(
			':username' => $_POST['username'],
			':password' => \Libs\Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
		));

		$data = $sth->fetch();

		$count = $sth->rowCount();

		$modulos = $this->db->select('SELECT * FROM modulos');
		foreach ($modulos as $indice => $modulo) {
			$modulos[$modulo['modulo']] = $modulo;
			unset($modulos[$indice]);
		}

		if($count > 0) {

			$user = [
				'id' => $data['userid'],
				'nome' => $data['username'],
				'hierarquia' => $data['hierarquia'],

			];

			// login
			\Libs\Session::init();
			\Libs\Session::set('loggedIn', true);
			\Libs\Session::set('usuario', $user);
			\Libs\Session::set('modulos', $modulos);

			header('location: ../dashboard');
		} else {
			header('location: ../login');
		}
	}
}