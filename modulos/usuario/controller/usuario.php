<?php
namespace Controller;

use Libs;

class Usuario extends \Libs\ControllerCrud {


	private $hierarquia_organizada = [];

	protected $modulo = [
		'modulo' 	=> 'usuario',
		'name'		=> 'Usuarios',
		'send'		=> 'Usuario'
	];

	protected $datatable = [
		'colunas' => ['ID', 'Email', 'Hierarquia', 'Ações'],
		'from'    => 'usuario'
	];


	public function index() {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "visualizar");

		$this->view->set_colunas_datatable($this->datatable['colunas']);

		$this->view->assign('hierarquia_list', $this->model->load_active_list('hierarquia'));
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/listagem/listagem');

	}

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca);

		$retorno = [];

		foreach($this->model->load_active_list('hierarquia') as $indice => $hierarquia) {
			$this->hierarquia_organizada[$hierarquia['id']] = $hierarquia['nome'];
		}

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['email'],
				!empty($item['hierarquia']) ? $this->hierarquia_organizada[$item['hierarquia']] : '',
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		return $retorno;
	}

	public function create(){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "criar");

		$insert_db = carregar_variavel('usuario');

		$insert_db += [
			"senha" => \Util\Hash::get_unic_hash()
		];

		$retorno = $this->model->insert('usuario', $insert_db);


		if($retorno['status']){
			$this->view->alert_js('Cadastro efetuado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	private function listagem($dados_linha){
		if(empty($dados_linha)){
			return false;
		}

		foreach ($this->model->load_active_list('hierarquia') as $indice => $hierarquia) {
			$hierarquias[$hierarquia['id']] = $hierarquia['nome'];
		};

		foreach ($dados_linha as $indice => $linha) {
			if($linha['super_admin'] != 1){

				$hierarquia_exibicao = isset($hierarquias[$linha['hierarquia']]) ? $hierarquias[$linha['hierarquia']] : 'Usuario Site' ;

			$botao_permitir_cadastro = $linha['hierarquia'] == 2 ?
				"<a href='/{$this->modulo['modulo']}/permitir_cadastro/{$linha['id']}' title='Permitir Cadastro'><i class='fa fa-thumbs-up fa-fw'></i></a>" :
				'';


			$botao_proibir_cadastro = $linha['hierarquia'] == 4 ?
				"<a href='/{$this->modulo['modulo']}/proibir_cadastro/{$linha['id']}' title='Proibir Cadastro'><i class='fa fa-thumbs-down fa-fw'></i></a>" :
				'';



				$retorno_linhas[] = [
					"<td class='sorting_1'>{$linha['id']}</td>",
	        		"<td>{$linha['email']}</td>",
	        		"<td>{$hierarquia_exibicao}</td>",
	        		"<td>" . $this->view->default_buttons_listagem($linha['id']) . $botao_permitir_cadastro . $botao_proibir_cadastro . "</td>"
				];
			}
		}

		if(!isset($retorno_linhas)){
			return false;
		}

		$this->view->linhas_datatable = $retorno_linhas;
	}

	public function editar($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro        = $this->model->load_cadastro($id[0])[0];
		$this->view->hierarquia_list = $this->model->load_active_list('hierarquia');
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/form/form');

	}

	public function visualizar($id){
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$this->view->cadastro = $this->model->load_cadastro($id[0])[0];
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/form/form');
		$this->view->lazy_view();
	}

	public function update($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar");


		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$update_db = carregar_variavel('usuario');

		debug2($update_db);

		if(empty($update_db['senha'])){
			unset($update_db['senha']);
		}

		$retorno = $this->model->update('usuario', $id[0], $update_db);

		if($retorno['status']){
			$update_db = carregar_variavel('pessoa');
			$retorno_pessoa = $this->model->update('pessoa', $id[0], $update_db);


		}

		if($retorno['status'] && $retorno_pessoa['status']){
			$this->view->alert_js('Cadastro editado com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a edição do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function delete($id) {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar");

		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		if($_SESSION['usuario']['id'] == $id[0]){
			$this->view->alert_js('Você não pode excluir seu proprio usuário!!!', 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$retorno = $this->model->delete('usuario', $id[0]);

		if($retorno['status']){
			$this->view->alert_js('Remoção efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function verificar_duplicidade_ajax(){
		echo json_encode(empty($this->model->load_user_by_email(carregar_variavel('usuario'))));
		exit;
	}

	public function perfil(){
		$cadastro = $this->model->carregar_usuario_por_id($_SESSION['usuario']['id']);
		$this->view->cadastro = $cadastro[0];
		$this->view->render('front/cabecalho_rodape', 'front/usuario/perfil');
	}

	public function update_perfil($id){
		$usuario = carregar_variavel('usuario');
		debug2($usuario);

		if(isset($usuario['senha']) && !empty($usuario['senha'])){
			$update_db = [
				'senha' => $usuario['senha']
			];

			$retorno_usuario = $this->model->update('usuario', $id[0], $update_db);
		}

		unset($update_db);

		$update_db = [
			'pronome' 	  => $usuario['pronome'],
    		'nome'        => $usuario['nome'],
    		'sobrenome'   => $usuario['sobrenome'],
    		'instituicao' => $usuario['instituicao'],
    		'atuacao'     => $usuario['atuacao'],
    		'lattes'      => $usuario['lattes'],
    		'grau'        => $usuario['grau'],
		];

		$retorno_pessoa = $this->model->update('pessoa', $id[0], $update_db);

		if($retorno_usuario['status'] == 1 || $retorno_pessoa['status'] == 1){
			$this->view->alert_js('Edição efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar o cadastro, por favor tente novamente...', 'erro');
		}

		header('location: /index');

	}

	public function permitir_cadastro($id){
		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo']);
			exit;
		}

		$update_db = [
			"hierarquia" => 4
		];

		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a alteração, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);

	}
	public function proibir_cadastro($id){
		if(empty($this->model->db->select("SELECT id FROM {$this->modulo['modulo']} WHERE id = {$id[0]} AND ativo = 1"))){
			$this->view->alert_js("{$this->modulo['send']} não existe...", 'erro');
			header('location: ' . URL . $this->modulo['modulo'] . '/');
			exit;
		}

		$update_db = [
			"hierarquia" => 2
		];

		$retorno = $this->model->update($this->modulo['modulo'], $id[0], $update_db);

		if($retorno['status']){
			$this->view->alert_js('Alteração efetuada com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a alteração, por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);

	}
}