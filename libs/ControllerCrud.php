<?php
namespace Libs;

class ControllerCrud extends \Libs\Controller {
	protected $modulo     = [];
	protected $colunas    = [];

	function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable($this->colunas);

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/listagem/listagem');
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

	public function create(){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$retorno = $this->model->create($this->modulo['modulo'], carregar_variavel($this->modulo['modulo']));

		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' cadastrado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function editar($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->full_load_by_id($this->modulo['modulo'], $id[0])[0];
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form');
	}

	public function update($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->check_if_exists($id[0]);

		$retorno = $this->model->update($this->modulo['modulo'], $id[0], carregar_variavel($this->modulo['modulo']));

		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function delete($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		$this->check_if_exists($id[0]);

		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);

		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' removido com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function visualizar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->full_load_by_id($this->modulo['modulo'], $id[0])[0];
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form', true);
	}
}