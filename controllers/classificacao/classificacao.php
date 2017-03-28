<?php
namespace Controllers;

use Libs;

class Classificacao extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'classificacao',
		'name'		=> 'Classificações',
		'send'		=> 'Classificação'
	];

	protected $colunas = ['ID', 'Classificação', 'Ascendente'];

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
				$item['nome'],
				$item['ascendente_nome'],
				$this->view->default_buttons_listagem($item['id'], true, true, false)
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
}