<?php
namespace Controllers;

use Libs;

class taxon extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'taxon',
		'name'		=> 'Taxon',
		'send'		=> 'Taxon'
	];

	protected $colunas = ['ID', 'Nome', 'Ascendente', 'Classificacao', 'Ações'];

	public function __construct() {
		parent::__construct();
		$this->view->modulo = $this->modulo;
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
				$item['classificacao_nome'],
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

	public function editar($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->carregar_taxon($id[0])[0];
		$this->view->classificacoes = $this->model->load_active_list('classificacao');
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


	public function visualizar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->check_if_exists($id[0]);

		$this->view->cadastro = $this->model->carregar_taxon($id[0])[0];
		$this->view->classificacoes = $this->model->load_active_list('classificacao');
		$this->view->visualizar = true;
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form', true);

	}

	public function buscar_taxon_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_taxon($busca);

		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			$add_cadastro[0] = [
				'id'               => $busca['nome'],
				'nome'             => "<strong>Cadastrar Novo Taxon: </strong>" . $busca['nome'],
				'id_classificacao' => isset($busca['id_classificacao']) ? $busca['id_classificacao'] : NULL
			];

			$retorno = array_merge($add_cadastro, $retorno);
		}

		echo json_encode($retorno);
		exit;
	}

	public function buscar_taxon_ajax(){
		echo json_encode($this->model->buscar_ascendencia(carregar_variavel('id')));
		exit;
	}

	public function buscar_ascendencia_ajax(){
		$busca = carregar_variavel('id_ascendente');

		echo json_encode($this->model->buscar_ascendencia($busca));
		exit;
	}
}