<?php
namespace Models;

use Libs;

/**
*
*/
class Hidroconsul_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function load_hidrocontrol_list(){
		$select = 'SELECT controle.*, trecho_loc.localizacao AS localizacao '
		. 'FROM hidrocontrol controle '
		. 'LEFT JOIN trecho trecho_loc ON controle.id_trecho = trecho_loc.id';

		return $this->db->select($select);
	}

	public function load_hidroconsul_list(){
		$select = 'SELECT hidroconsul.*, trecho.localizacao AS trecho_localizacao '
		. 'FROM hidroconsul '
		. 'LEFT JOIN trecho '
		. "on hidroconsul.id_trecho = trecho.id";

		return $this->db->select($select);
	}




}
