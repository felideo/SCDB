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

	public function modulos_list() {
		return $this->db->select('SELECT * FROM modulos');
	}
}
