<?php
namespace Models;

use Libs;

class Modulo_Model extends \Libs\Model {
	public function __construct() {
		parent::__construct();
	}

	public function permissoes_basicas($modulo, $id_modulo){
		$permissoes_basicas = [
			'criar' => [
				'modulo' => $id_modulo,
				'permissao' => $modulo . '_criar',
				'hash' => \Util\Hash::get_unic_hash()
			],
			'visualizar' => [
				'modulo' => $id_modulo,
				'permissao' => $modulo . '_visualizar',
				'hash' => \Util\Hash::get_unic_hash()
			],
			'editar' => [
				'modulo' => $id_modulo,
				'permissao' => $modulo . '_editar',
				'hash' => \Util\Hash::get_unic_hash()
			],
			'deletar' => [
				'modulo' => $id_modulo,
				'permissao' => $modulo . '_deletar',
				'hash' => \Util\Hash::get_unic_hash()
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
