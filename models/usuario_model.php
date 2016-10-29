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
}