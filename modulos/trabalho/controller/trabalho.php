<?php
namespace Controller;

use Libs;
use Libs\URL;
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
				$retorno_tratado[$retorno['id']]['palavra'] .= ', ' . $retorno['palavra'];
			}
		}

		$retorno = [];

		foreach ($retorno_tratado as $indice => $item) {

			$retorno[] = [
				$item['id'],
				$item['titulo'],
				$item['nome'],
				$item['palavra'],


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

	public function create(){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "criar");

		$trabalho = carregar_variavel('trabalho');

		debug2($trabalho);
		exit;

		$insert_trabalho_db              = $trabalho['trabalho'];
		$insert_trabalho_db['id_curso']  = $this->tratar_curso($insert_trabalho_db['id_curso']);
		$insert_trabalho_db['id_campus'] = $this->tratar_campus($insert_trabalho_db['id_campus']);

		$retorno_trabalho = $this->model->insert('trabalho', $insert_trabalho_db);

		debug2($retorno_trabalho);
		if(!empty($retorno_trabalho['status'])){
			$retorno_trabalho = ['id' => $retorno_trabalho['id']];
			$retorno_trabalho += $insert_trabalho_db;

			$url = new URL;
			$retorno_url = $url->setId($retorno_trabalho['id'])
				->setUrl($insert_trabalho_db['titulo'])
				->setController($this->modulo['modulo'])
				->cadastrarUrlAmigavel();


			// ::cadastrar_url_amigavel($this->modulo['modulo'], $insert_trabalho_db['titulo'], $retorno_trabalho['id']);

		debug2($trabalho);
		debug2($retorno_url);
		exit;

			return $retorno['id'];
		}


		debug2($_POST);
		exit;

		// $this->model->insert('trabalho', )
		$this->model->insert($this->modulo['modulo'], carregar_variavel($this->modulo['modulo']));

	}
	private function tratar_curso($curso){
		if(is_numeric($curso)){
			return $curso;
		}

		$insert_db['curso'] = $curso;

		$retorno = $this->model->insert('curso', $insert_db);

		if(!empty($retorno['status'])){
			return $retorno['id'];
		}else{
			$this->view->warning_js('Ocorreu um erro ao cadastrar o curso. Por favor edite o trabalho para corrigir', 'erro');
		}
	}

	private function tratar_campus($campus){
		if(is_numeric($campus)){
			return $campus;
		}

		$insert_db['campus'] = $campus;

		$retorno = $this->model->insert('campus', $insert_db);

		if(!empty($retorno['status'])){
			return $retorno['id'];
		}else{
			$this->view->warning_js('Ocorreu um erro ao cadastrar o campus. Por favor edite o trabalho para corrigir', 'erro');
		}
	}


}