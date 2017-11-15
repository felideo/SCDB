<?php
namespace Model;

use Libs;

<<<<<<< HEAD
/**
*
*/
class usuario_model extends \Libs\Model
{
=======
class Usuario extends \Libs\Model{
>>>>>>> d895410... DEV - SWDB * ajuste final em todos os modulos na nova estrutura * incremento na abstração do carregamento do datatable!

	public function __construct() {
		parent::__construct();
	}

	public function carregar_listagem($busca, $datatable = null){
		$select = "SELECT"
			. " 	usuario.id,"
			. " 	usuario.email,"
			. " 	usuario.hierarquia"
			. " FROM"
			. " 	usuario usuario"
			. " WHERE"
			. " 	usuario.ativo = 1";

		if(isset($busca['search']['value']) && !empty($busca['search']['value'])){
			$select .= " AND usuario.id LIKE '%{$busca['search']['value']}%'";
			$select .= " OR usuario.email LIKE '%{$busca['search']['value']}%'";
			$select .= " OR usuario.hierarquia LIKE '%{$busca['search']['value']}%'";
		}

		if(isset($busca['order'][0])){
			if($busca['order'][0]['column'] == 0){
				$select .= " ORDER BY usuario.id {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 1){
				$select .= " ORDER BY usuario.email {$busca['order'][0]['dir']}";
			}elseif($busca['order'][0]['column'] == 2){
				$select .= " ORDER BY usuario.hierarquia {$busca['order'][0]['dir']}";
			}
		}

		if(isset($busca['start']) && isset($busca['length'])){
			$select .= " LIMIT {$busca['start']}, {$busca['length']}";
		}

		return $this->db->select($select);
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