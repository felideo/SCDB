<?php
namespace Controller;

use Libs;

class Palavra_chave extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'palavra_chave',
		'name'		=> 'Palavras Chaves',
		'send'		=> 'Palavra Chave'
	];

	protected $colunas = ['ID', 'palavra_chave', 'Ações'];

	function __construct() {
		parent::__construct();
	}

	public function carregar_listagem_ajax(){
		$busca = [
			'order'  => carregar_variavel('order'),
			'search' => carregar_variavel('search'),
			'start'  => carregar_variavel('start'),
			'length' => carregar_variavel('length'),
		];

		$query = $this->model->carregar_listagem($busca);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['palavra_chave'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->db->select("SELECT count(id) AS total FROM {$this->modulo['modulo']} WHERE ativo = 1")[0]['total']),
            "data"            => $retorno
        ]);

		exit;
	}

	public function buscar_palavra_chave_select2(){
		$busca = carregar_variavel('busca');
		$retorno = $this->model->buscar_palavra_chave($busca);

		echo json_encode($retorno);
		exit;

	}
}