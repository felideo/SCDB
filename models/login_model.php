<?php
namespace Models;

use Libs;

class Login_Model extends \Libs\Model {

	function __construct() {
		parent::__construct();
	}

	public function run() {
	
		\Libs\Session::init();
		
		$this->sign_in();
		$this->load_modulos_and_menus();

		if($_SESSION['logado'] == true){
			header('location: ../painel_controle');
		} else {
			header('location: ../login');
		}
	}

	private function sign_in(){
		$sth = $this->db->prepare("SELECT * FROM usuario WHERE
			email = :email AND senha = :senha");

		$sth->execute(array(
			':email' => $_POST['email'],
			// ':senha' => \Libs\Hash::create('sha256', $_POST['senha'], HASH_PASSWORD_KEY)
			':senha' => $_POST['senha']
		));

		$data = $sth->fetch();
		$count = $sth->rowCount();

		if($count > 0) {
			$user = [
				'id' => $data['id'],
				'nome' => $data['email'],
				'hierarquia' => $data['hierarquia'],
			];
		}

		\Libs\Session::set('logado', true);
		\Libs\Session::set('usuario', $user);
	}

	private function load_modulos_and_menus(){
		$modulos = $this->db->select('SELECT * FROM modulo WHERE ATIVO = 1 ORDER BY ordem');
		$submenus = $this->db->select('SELECT * FROM submenu WHERE ATIVO = 1');

		foreach ($modulos as $indice_01 => $modulo) {
			if(empty($modulo['id_submenu'])){
				$menus[$modulo['nome']][0] = $modulo;
			} else {
				foreach ($submenus as $indice_02 => $submenu) {

					debug2($submenu);

					$menus[$submenu['nome']]['icone'] = $submenu['icone'];
					$menus[$submenu['nome']]['nome_exibicao'] = $submenu['nome_exibicao'];
					
					if($modulo['id_submenu'] == $submenu['id']){
						$menus[$submenu['nome']]['modulos'][$modulo['modulo']] = $modulo;
					}
				}

			}
		}

		\Libs\Session::set('modulos', $modulos);
		\Libs\Session::set('menus', $menus);
	}
}