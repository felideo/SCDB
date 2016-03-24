<?php
namespace Libs;

/**
* classe Model
*/


abstract class Model {
	function __construct() {

		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
	}

	public function create($table, $data) {
		$this->db->insert($table, $data);
	}

	public function load_full_list($table){
		$full_list = 'SELECT * FROM ' . $table;
		return $this->db->select($full_list);
	}

}