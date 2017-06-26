<?php
namespace Controllers;

use Libs;

class Nome_Popular extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'nome_popular',
		'name'		=> 'Nomes Populares',
		'send'		=> 'Nome Popular'
	];

	protected $colunas = ['ID', 'Nome Popular', 'Organismo', 'Ações'];

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

		foreach ($query as $indice => $retorno) {
			if(empty($retorno['id'])){
				unset($query[$indice]);
			}
		}

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['nome'],
				$item['nome_organismo'],
				$this->view->default_buttons_listagem($item['id'])
			];
		}

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->db->select("SELECT count(id) AS total FROM nome_popular WHERE ativo = 1")[0]['total']),
            "data"            => $retorno   // total data array
        ]);

		exit;
	}
}