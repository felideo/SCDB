<?php
namespace Models;

use Libs;

/**
*
*/
class Modulos_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function delete($id) {

		$data = [
			'visivel' => 0,
		];

		$result = $this->db->update('trecho', $data, "`id` = {$id}");
	}
}
