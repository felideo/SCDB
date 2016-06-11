<?php
namespace Models;

use Libs;

/**
*
*/
class Modulo_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function delete($table, $id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update($table, $data, "`id` = {$id}");
		return $result;
	}
}
