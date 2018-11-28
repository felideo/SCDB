<?php
namespace Controller;

use Libs;

class Orientador extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' => 'orientador',
		'name'   => 'Orientadores',
		'send'   => 'Orientador',
		'table'  => 'pessoa'
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Ações'],
		'from'    => 'pessoa',
		'ordenacao_desabilitada' => '1, 4'
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
				$item['pronome'],
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



		$orientador = [
			'pessoa'     => [
				'pronome'    => $dados['pronome'],
				'link'       => $dados['link'],
				'orientador' => 1,
			],
			'usuario'    => [
				'email'      => $dados['email'],
				'hierarquia' => 10,
			],
		];

		if(isset($dados['nome']) && !empty($dados['nome'])){
			$orientador['pessoa']['nome']       = str_replace(end(explode(' ', $dados['nome'])), '', $dados['nome']);
			$orientador['pessoa']['sobrenome']  = end(explode(' ', $dados['nome']));
		}

		$controller_usuario = $this->get_controller('usuario');
		$orientador         = $controller_usuario->insert_update($orientador, $where);

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
		$orientador_utilizado = $this->model->query->select('
				rel_orientador.id_pessoa,
				rel_orientador.id_trabalho
			')
			->from('trabalho_relaciona_orientador rel_orientador')
			->where("rel_orientador.id_pessoa = {$id[0]} AND rel_orientador.ativo = 1")
			->fetchArray();

		if(!empty($orientador_utilizado)){
			$msg = 'O orientador esta relacionado ao(s) trabalho(s) ID numero: ';

			foreach($orientador_utilizado as $indice => $trabalho){
				$msg .= $trabalho['id_trabalho'] . ', ';
			}

			$msg = rtrim($msg, ', ');
			$msg .= '. Exclusão negada! Remova manualmente este orientador de todos os trabalhos antes de tentar excluir-lo.';

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

	public function buscar_orientador_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_orientador($busca);

		if(empty($retorno)){
			$retorno = [];
		}

		foreach($retorno as $indice => &$item){
			$item['nome'] = $item['nome'] . ' ' . $item['sobrenome'];
		}

		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			$add_cadastro[0] = [
				'id'               => $busca['nome'],
				'nome'             => "<strong>Cadastrar Novo Orientador: </strong>" . $busca['nome']
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