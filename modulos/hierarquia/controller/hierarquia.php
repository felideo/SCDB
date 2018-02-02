<?php
namespace Controller;

use Libs;

class Hierarquia extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'hierarquia',
		'name'		=> 'Hierarquias',
		'send'		=> 'Hierarquia'
	];

	protected $colunas = ['ID', 'Nome', 'Ações'];

	protected $datatable = [
		'colunas' => ['ID', 'Nome', 'Ações'],
		'from'    => 'hierarquia',
	];

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], "visualizar");
		$this->view->assign('permissao_criar', \Util\Permission::check_user_permission($this->modulo['modulo'], 'criar'));


		$this->view->set_colunas_datatable(['ID', 'Nome', 'Ações']);
		// $this->listagem($this->model->load_active_list($this->modulo['modulo']));

		$this->view->assign('permissoes_list', $this->load_external_model('permissao')->load_permissions_list());
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/listagem/listagem');

	}

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['nome'],
				$item['id'] != 1 ? $this->view->default_buttons_listagem($item['id'], true, true, true) : $this->view->default_buttons_listagem($item['id'], true, true, false)
			];
		}

		return $retorno;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], "editar");

		$this->view->assign('cadastro', $this->model->load_hierarquia($id[0]));
		$this->view->assign('permissoes_list', $this->load_external_model('permissao')->load_permissions_list());
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/form/form');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], "visualizar");

		$this->view->assign('cadastro', $this->model->load_hierarquia($id[0]));
		$this->view->assign('permissoes_list', $this->load_external_model('permissao')->load_permissions_list());
		$this->view->lazy_view();
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/form/form');
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], "criar");

		$insert_db = ['nome' => carregar_variavel($this->modulo['modulo'])];

		$retorno   = $this->model->insert($this->modulo['modulo'], $insert_db);

		if($retorno['status']){
			$hierarquia_relaciona_permissao = carregar_variavel('hierarquia_relaciona_permissao');

			if(isset($hierarquia_relaciona_permissao) && !empty(carregar_variavel('hierarquia_relaciona_permissao'))){
				foreach ($hierarquia_relaciona_permissao as $indice => $permissao) {
						$insert_permissao = [
							'id_hierarquia' => $retorno['id'],
							'id_permissao' => $permissao
						];

					$retorno_permissoes[] = $this->model->insert('hierarquia_relaciona_permissao', $insert_permissao);
					unset($insert_permissao);

				}
			}
		}

		if($retorno['status'] && $retorno_permissoes[count($retorno_permissoes)]['erros'] == 0){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], "editar");

		$update_db = ['nome' => carregar_variavel($this->modulo['modulo'])];
		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);

		if($retorno['status']){
			$retorno = $this->model->update_relacao('hierarquia_relaciona_permissao', 'id_hierarquia', $id[0], ['ativo' => 0]);
			foreach (carregar_variavel('hierarquia_relaciona_permissao') as $indice => $permissao) {
				$insert_permissao = [
					'id_hierarquia' => $id[0],
					'id_permissao' => $permissao
				];

				$retorno_permissoes[] = $this->model->insert('hierarquia_relaciona_permissao', $insert_permissao);
				unset($insert_permissao);
			}
		}

		if($retorno['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');

			unset($_SESSION['permissoes']);

				$hierarquia = empty($_SESSION['usuario']['hierarquia']) ? 'NULL' : $_SESSION['usuario']['hierarquia'];

				$select = 'SELECT hierarquia.id as id_hierarquia, hierarquia.nome,'
					. ' relacao.id as id_relacao,'
					. ' permissao.id as id_permissao, permissao.permissao, permissao.id_modulo,'
					. ' modulo.modulo'
					. ' FROM hierarquia hierarquia'
					. ' LEFT JOIN hierarquia_relaciona_permissao relacao'
					. ' ON relacao.id_hierarquia = hierarquia.id AND relacao.ativo = 1'
					. ' LEFT JOIN permissao permissao'
					. ' ON permissao.id = relacao.id_permissao'
					. ' LEFT JOIN modulo modulo'
					. ' ON modulo.id = permissao.id_modulo'
					. ' WHERE hierarquia.id = ' . $hierarquia;

				$permissoes = $this->model->db->select($select);

				if(!empty($permissoes)){
					foreach($permissoes as $indice => $permissao){
						$retorno_permissoes[$permissao['modulo']][$permissao['permissao']] = $permissao;
					}

					\Libs\Session::set('permissoes', $retorno_permissoes);
				}

		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], "deletar");

		$retorno = $this->model->delete($this->modulo['modulo'], $id[0]);
		$retorno = $this->model->delete('permissao', $id[0]);
		$retorno = $this->model->delete('hierarquia_relaciona_permissao', $id[0]);


		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}
}