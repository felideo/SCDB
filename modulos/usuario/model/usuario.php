<?php
namespace Models;

use Libs;
use \Libs\QueryBuilder\QueryBuilder;

class usuario_model extends \Libs\Model{

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
			$select = "SELECT * FROM usuario WHERE email = '{$email}' AND ativo = 1";

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

	public function load_cadastro($id){
		$query = new QueryBuilder($this->db);
		return $query->select('
			usuario.*,
			pessoa.*
		')
			->from('usuario usuario')
			->leftJoin('pessoa pessoa ON pessoa.id_usuario = usuario.id AND pessoa.ativo = 1')
			->where("usuario.id = {$id} AND usuario.ativo = 1")
			->fetchArray('first');
	}

	public function carregar_usuario_por_id($id){
		$query = new QueryBuilder($this->db);
		$retorno = $query->select('
			usuario.email,
			usuario.hierarquia,
			pessoa.pronome,
			pessoa.nome,
			pessoa.sobrenome.
			pessoa.instituicao,
			pessoa.atuacao,
			pessoa.lattes,
			pessoa.grau,
			pessoa.instituicao,
		')
		->from('usuario usuario')
		->leftJoin('pessoa pessoa ON pessoa.id_usuario = usuario.id AND pessoa.ativo = 1')
		->where("usuario.ativo = 1 AND usuario.id = {$id}")
		->fetchArray('first');

		return $retorno;
	}
}