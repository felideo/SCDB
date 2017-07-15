<?php
namespace Controllers;

use Libs;

class Hierarquia extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'hierarquia',
		'name'		=> 'Hierarquias',
		'send'		=> 'Hierarquia'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->set_colunas_datatable(['ID', 'Nome', 'Ações']);
		$this->listagem($this->model->load_active_list($this->modulo['modulo']));

		$this->view->permissoes_list = $this->load_external_model('permissao')->load_permissions_list();
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/listagem/listagem');
	}

	public function listagem($dados_linha){
		foreach ($dados_linha as $indice => $linha) {
			$url = URL;

			$botao_visualizar = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar") ?
				"<a href='/{$this->modulo['modulo']}/visualizar/{$linha['id']}' title='Visualizar'><i class='fa fa-eye fa-fw'></i></a>" :
				'';

			$botao_editar = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar") ?
				"<a href='/{$this->modulo['modulo']}/editar/{$linha['id']}' title='Editar'><i class='fa fa-pencil fa-fw'></i></a>" :
				 '';

			if(\Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar")
				&& $linha['id'] > 3
				&& $this->model->db->select("SELECT COUNT(id) AS n_usuarios FROM usuario WHERE hierarquia =  {$linha['id']}")[0]['n_usuarios'] <= 0)
			{
					$botao_excluir = "<a href='/{$this->modulo['modulo']}/delete/{$linha['id']}' title='Deletar'><i class='fa fa-trash-o fa-fw'></i></a>";
			}else{
				$botao_excluir = '';
			}

			$retorno_linhas[] = [
				"<td class='sorting_1'>{$linha['id']}</td>",
				"<td>{$linha['nome']}</td>",
	        	"<td>" . $botao_visualizar . $botao_editar . $botao_excluir . "</td>"
			];
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$this->view->cadastro = $this->model->load_hierarquia($id[0]);
		$this->view->permissoes_list = $this->load_external_model('permissao')->load_permissions_list();
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/editar/editar');
	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");

		$this->view->cadastro = $this->model->load_hierarquia($id[0]);
		$this->view->permissoes_list = $this->load_external_model('permissao')->load_permissions_list();
		$this->view->render('back/cabecalho_rodape_sidebar', 'back/' . $this->modulo['modulo'] . '/editar/editar');
		$this->view->lazy_view();
	}

	public function create() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$insert_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->create($this->modulo['modulo'], $insert_db);

		if($retorno['status']){
			$hierarquia_relaciona_permissao = carregar_variavel('hierarquia_relaciona_permissao');

			if(isset($hierarquia_relaciona_permissao) && !empty(carregar_variavel('hierarquia_relaciona_permissao'))){
				foreach (carregar_variavel('hierarquia_relaciona_permissao') as $indice => $permissao) {
						$insert_permissao = [
							'id_hierarquia' => $retorno['id'],
							'id_permissao' => $permissao
						];

					$retorno_permissoes[] = $this->model->create('hierarquia_relaciona_permissao', $insert_permissao);
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
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		$update_db = carregar_variavel($this->modulo['modulo']);
		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);

		if($retorno['status']){
			$retorno = $this->model->update_relacao('hierarquia_relaciona_permissao', 'id_hierarquia', $id[0], ['ativo' => 0]);
			foreach (carregar_variavel('hierarquia_relaciona_permissao') as $indice => $permissao) {
				$insert_permissao = [
					'id_hierarquia' => $id[0],
					'id_permissao' => $permissao
				];

				$retorno_permissoes[] = $this->model->create('hierarquia_relaciona_permissao', $insert_permissao);
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
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

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