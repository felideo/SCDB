<?php
namespace Models;

use Libs;

class Candidato_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function create($table, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->get_insert($table, $data);
	}

	public function update($table, $id, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->db->update($table, $data, "`id` = {$id}");
	}

	public function update_relacao($table, $where, $id, $data){
		return $this->db->update($table, $data, "`{$where}` = {$id}");
	}
}
