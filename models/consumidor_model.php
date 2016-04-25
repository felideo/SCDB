<?php
namespace Models;

use Libs;


class Consumidor_Model extends \Libs\Model {

	public function __construct() {
		parent::__construct();
	}

	public function load_ap_list(){
		$consumidores = $this->db->select('SELECT * from consumidor');

		if(!empty($consumidores)){
			$aps_ocupados = null;

			foreach ($consumidores as $key => $consumidor) {
				$aps_ocupados .= $consumidor['id_hidroconsul'] . ", ";
			}
			$aps_ocupados = rtrim($aps_ocupados, ', ');
		}

		$select = 'SELECT * '
		. 'FROM hidroconsul '
		. 'WHERE hidroconsul.ativo = 1 ';

		if(!empty($aps_ocupados)){
			$select	.= 'AND id NOT IN (' . $aps_ocupados . ')';
		}

		return $this->db->select($select);
	}

	public function load_consumidor_list(){
		$select = 'SELECT consumidor.*, trecho.localizacao AS trecho_localizacao, hidroconsul.localizacao AS hidroconsul_localizacao '
		. 'FROM consumidor '
		. 'LEFT JOIN trecho ON trecho.id = consumidor.id_trecho '
		. 'LEFT JOIN hidroconsul ON hidroconsul.id = consumidor.id_hidroconsul ';

		return $this->db->select($select);
	}
}