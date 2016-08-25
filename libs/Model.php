<?php
namespace Libs;

/**
* classe Model
*/

abstract class Model {
	function __construct() {
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	public function get_insert($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function load_full_list($table){
		$full_list = 'SELECT * FROM ' . $table;
		return $this->db->select($full_list);
	}

	public function load_active_list($table) {
		$select = 'SELECT * FROM ' . $table . ' WHERE ativo = 1';
		return $this->db->select($select);
	}

	public function delete($table, $id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update($table, $data, "`id` = {$id}");

		return $result;
	}

	public function full_load_by_id($table, $id){
		$query = 'SELECT * FROM ' . $table
			. ' WHERE ID = ' . $id;
		return $this->db->select($query);
	}

	public function full_load_by_column($table, $column, $id){
		$query = 'SELECT * FROM ' . $table
			. ' WHERE ' . $column . ' = ' . $id
			. ' AND ativo = 1';
		return $this->db->select($query);
	}


}