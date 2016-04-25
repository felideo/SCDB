<?php
namespace Models;

use Libs;

/**
*
*/
class Hidrocontrol_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function load_hidrocontrol_list(){
		$select = 'SELECT controle.*, trecho_loc.localizacao AS localizacao, trecho_anterior.localizacao AS trecho_anterior '
    	. 'FROM hidrocontrol controle '
    	. 'LEFT JOIN trecho trecho_loc ON   controle.id_trecho = trecho_loc.id '
    	. 'LEFT JOIN trecho trecho_anterior ON controle.trecho_anterior = trecho_anterior.id';

		return $this->db->select($select);
	}

	public function load_trecho_free_list($ralacionad_a){

		$hidrocontrols = $this->db->select('SELECT ' . $ralacionad_a . ' from hidrocontrol');

		if(!empty($hidrocontrols)){
			$trechos_ocupados = null;

			foreach ($hidrocontrols as $key => $hidrocontrol) {
				$trechos_ocupados .= $hidrocontrol[$ralacionad_a] . ", ";
			}
			$trechos_ocupados = rtrim($trechos_ocupados, ', ');
		}

		$select = 'SELECT * '
		. 'FROM trecho '
		. 'WHERE trecho.ativo = 1 ';

		if(!empty($hidrocontrols)){
			$select	.= 'AND id NOT IN (' . $trechos_ocupados . ')';
		}

		return $this->db->select($select);
	}
}
