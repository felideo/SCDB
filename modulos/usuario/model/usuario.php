<?php
namespace Models;

use Libs;

/**
*
*/
class usuario_model extends \Libs\Model
{

	public function __construct() {
		parent::__construct();
	}

	public function create($table, $data) {

		$data += [
			'ativo' => 1,
		];

		// $data['senha'] = \Libs\Hash::create('sha1', $data['senha'], HASH_PASSWORD_KEY);

		return $this->get_insert($table, $data);
	}

	public function load_user_by_email($email){
		try {
			$select = "SELECT * FROM usuario WHERE email = '{$email} AND ativo = 1'";

			return $this->db->select($select);
		}catch(Exception $e){
            if (ERROS) throw new Exception('<pre>' . $e->getMessage() . '</pre>');
		}
	}

	public function check_token($token){
		try {
			$select = "SELECT * FROM usuario WHERE token = '{$token}'";
			return $this->db->select($select);
		}catch(Exception $e){
            if (ERROS) throw new Exception('<pre>' . $e->getMessage() . '</pre>');
		}
	}
}