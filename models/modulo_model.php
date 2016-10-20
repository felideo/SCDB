<?php
namespace Models;

use Libs;

class Modulo_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function load_modulo_list(){
		$select = 'SELECT modulo.*, submenu.id as id_submenu, submenu.nome as submenu_nome, submenu.nome_exibicao as submenu_nome_exibicao, submenu.icone as submenu_icone'
	    	. ' FROM modulo modulo'
    		. ' LEFT JOIN submenu submenu ON submenu.id = modulo.id_submenu AND submenu.ativo = 1'
	    	. ' WHERE modulo.ativo = 1';

	    return $this->db->select($select);
	}
}
