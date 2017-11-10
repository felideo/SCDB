<?php
namespace Controller;

use Libs;

class Modulo extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'modulo',
		'name'		=> 'Módulos',
		'send'		=> 'Módulo'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Modulo', 'Ordem' ,'Submenu', 'Link', 'Acesso', 'Icone', 'Ações']);
		$this->listagem($this->model->load_modulo_list($this->modulo['modulo']));

		$this->view->submenu_list = $this->model->load_active_list('submenu');
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/listagem/listagem');
	}

	public function listagem($dados_linha){
		// ordem
		foreach ($dados_linha as $indice => $linha) {
			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id']}</td>",
	        	"<td>{$linha['nome']}</td>",
	        	"<td>{$linha['ordem']}</td>",

	        	"<td><i class='fa {$linha['submenu_icone']} fa-fw'></i> {$linha['submenu_nome_exibicao']} </td>",
	        	"<td>/{$linha['modulo']}</td>",
	        	$linha['hierarquia'] == 0 ? "<td>Super Admin</td>" : "<td></td>",
	        	"<td><i class='fa {$linha['icone']} fa-fw'></i> {$linha['icone']}</td>",
	        	"<td>" . $this->view->default_buttons_listagem($linha['id']) . "</td>"
			];
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->view->cadastro = $this->model->full_load_by_id('modulo', $id[0])[0];
		$this->view->submenu_list = $this->model->load_active_list('submenu');
		// $this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/form/form');
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/form/form');


	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->cadastro = $this->model->full_load_by_id('modulo', $id[0])[0];
		$this->view->submenu_list = $this->model->load_active_list('submenu');

		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/listagem/listagem');
		$this->view->lazy_view();
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");
		$insert_db = carregar_variavel($this->modulo['modulo']);

		if(empty($insert_db['id_submenu'])){
			$insert_db['id_submenu'] = NULL;
		}

		$retorno = $this->model->create($this->modulo['modulo'], $insert_db);

		if($retorno['status']){
			$retorno_permissoes = $this->model->permissoes_basicas($insert_db['modulo'], $retorno['id']);
		}

		if($retorno['status'] && $retorno_permissoes[count($retorno_permissoes)]['erros'] == 0){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");
		$update_db = carregar_variavel($this->modulo['modulo']);

		if(empty($update_db['id_submenu'])){
			$update_db['id_submenu'] = NULL;
		}

		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}
}



