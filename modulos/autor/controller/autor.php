<?php
namespace Controller;

use Libs;

class Autor extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'autor',
		'name'		=> 'Autores',
		'send'		=> 'Autor',
		'table'  => 'pessoa'
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Ações'],
		'from'    => 'orientador',
	];

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		if(empty($query)){
			return $retorno;
		}

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['nome'] . ' ' . $item['sobrenome'],
				$item['usuario'][0]['email'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		return $retorno;
	}

	public function insert_update($dados, $where = null){
		if(isset($where['id']) && !empty($where['id'])){
			if(is_numeric($dados['nome'])){
				unset($dados['nome']);
			}

			if(isset($dados['id_usuario']) && !empty($dados['id_usuario'])){
				$where['id'] = $dados['id_usuario'];
				unset($dados['id_usuario']);
			}
		}

		$autor = [
			'pessoa'     => [
				'nome'      => str_replace(end(explode(' ', $dados['nome'])), '', $dados['nome']),
				'sobrenome' => end(explode(' ', $dados['nome'])),
				'link'      => $dados['link'],
				'autor'     => 1,
			],
			'usuario'    => [
				'email'      => $dados['email'],
				'hierarquia' => 10,
				'bloqueado'  => 1,
				'oculto'     => 1
			],
		];

		$controller_usuario = $this->get_controller('usuario');
		$orientador         = $controller_usuario->insert_update($autor, $where);

		return $orientador;
	}

	public function middle_visualizar($id){
		$cadastro = $this->model->load_cadastro($id)[0];
		$this->view->assign('cadastro', $cadastro);
	}

	public function middle_editar($id){
		$cadastro = $this->model->load_cadastro($id)[0];
		$this->view->assign('cadastro', $cadastro);
	}


	public function middle_delete($id) {
		$autor_utilizado = $this->model->query->select('
				rel_autor.id_autor,
				rel_autor.id_trabalho
			')
			->from('trabalho_relaciona_autor rel_autor')
			->where("rel_autor.id_autor = {$id[0]} AND rel_autor.ativo = 1")
			->fetchArray();

		if(!empty($autor_utilizado)){
			$msg = 'O autor esta relacionado ao(s) trabalho(s) ID numero: ';

			foreach($autor_utilizado as $indice => $trabalho){
				$msg .= $trabalho['id_trabalho'] . ', ';
			}

			$msg = rtrim($msg, ', ');
			$msg .= '. Exclusão negada! Remova manualmente este autor de todos os trabalhos antes de tentar excluir-lo.';

			$this->view->alert_js($msg, 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		$retorno = $this->model->delete($this->modulo['table'], ['id' => $id[0]]);

		if($retorno['status']){
			$pessoa = $this->model->query->select('
					pessoa.id_usuario,
				')
				->from('pessoa pessoa')
				->where("pessoa.id = {$id[0]}")
				->fetchArray();

			if(isset($pessoa[0]['id_usuario']) && !empty($pessoa[0]['id_usuario'])){
				$retorno_usuario = $this->model->delete('usuario', ['id' => $pessoa[0]['id_usuario']]);
			}
		}

		return $retorno;
	}

	public function buscar_autor_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_autor($busca);

		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			$add_cadastro[0] = [
				'id'               => $busca['nome'],
				'nome'             => "<strong>Cadastrar Novo Autor: </strong>" . $busca['nome']
			];

			$retorno = array_merge($add_cadastro, $retorno);
		}

		foreach($retorno as &$item){
			$item['validar'] = true;
		}

		echo json_encode($retorno);
		exit;
	}
}