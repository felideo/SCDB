<?php
namespace Models;

use Libs;


class Trecho_Model extends \Libs\Model {

	public function __construct() {
		parent::__construct();
	}

	public function trecho_list() {
		return $this->db->select('SELECT * FROM trecho WHERE ativo = 1');
	}

	public function delete($id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update('trecho', $data, "`id` = {$id}");
	}
}