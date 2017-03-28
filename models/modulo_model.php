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

	public function permissoes_basicas($modulo, $id_modulo){
		$permissoes_basicas = [
			'criar' => [
				'id_modulo' => $id_modulo,
				'permissao' => $modulo . '_criar',
			],
			'visualizar' => [
				'id_modulo' => $id_modulo,
				'permissao' => $modulo . '_visualizar',
			],
			'editar' => [
				'id_modulo' => $id_modulo,
				'permissao' => $modulo . '_editar',
			],
			'deletar' => [
				'id_modulo' => $id_modulo,
				'permissao' => $modulo . '_deletar',
			]
		];

		$erros = 0;

		foreach ($permissoes_basicas as $indice => $permissao) {
			$retorno[$indice] = $this->get_insert('permissao', $permissao);
			$erros = !empty($retorno[$indice]['id']) ? $erros++ : $erros;

			$retorno[$indice]['erros'] = $erros;
		}

		return $retorno;
	}
}