<?php
namespace Libs;

/**
* classe Model
*/

abstract class Model {
	function __construct() {
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	public function create($table, $data){
		$data += [
			'ativo' => 1,
		];

		return $this->get_insert($table, $data);
	}

	public function get_insert($table, $data) {
		return $this->db->insert($table, $data);
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

	public function delete($table, $id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update($table, $data, "`id` = {$id}");

		return $result;
	}

	public function delete_relacao($table, $where, $id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update($table, $data, "`{$where}` = {$id}");

		return $result;
	}


	public function load_full_list($table){
		$full_list = 'SELECT * FROM ' . $table;
		return $this->db->select($full_list);
	}

	public function load_active_list($table) {
		$select = 'SELECT * FROM ' . $table . ' WHERE ativo = 1';
		return $this->db->select($select);
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


	public function update_relacao($table, $where, $id, $data){
		return $this->db->update($table, $data, "`{$where}` = {$id}");
	}

	public function create($table, $data){
		return $this->get_insert($table, $data);
	}

	public function update($table, $id, $data){
		return $this->db->update($table, $data, "`id` = {$id}");
	}


}