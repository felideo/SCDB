<?php
namespace Controllers;

use Libs;

class Trabalho extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'trabalho',
		'name'		=> 'Trabalhos',
		'send'		=> 'trabalho'
	];

	protected $colunas = ['ID', 'Titulo', 'Autor', 'Palavras Chave', 'Ações'];

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

		$retorno_tratado = [];

		foreach ($query as $indice => $retorno) {
			if(!isset($retorno_tratado[$retorno['id']])){
				$retorno_tratado[$retorno['id']] = $retorno;
			}else{
				$retorno_tratado[$retorno['id']]['palavra_chave'] .= ', ' . $retorno['palavra_chave'];
			}
		}

		$retorno = [];

		foreach ($retorno_tratado as $indice => $item) {

			$retorno[] = [
				$item['id'],
				$item['titulo'],
				$item['nome'],
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


	public function visualizar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");
		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->carregar_trabalho($id[0]);

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form');

		$this->view->lazy_view();
	}

}