<?php
namespace Models;

use Libs;


class Hidrocontrol extends \Libs\Model {

	public function __construct() {
		parent::__construct();
	}

	public function hidrometro_controle_list() {
		return $this->db->select('SELECT * FROM hidrometro_controle WHERE ativo = 1');
	}

	public function delete($id) {

		$data = [
			'ativo' => 0,
		];

		$result = $this->db->update('hidrometro_controle', $data, "`id` = {$id}");
	}
}