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

	// protected $datatable = [
	// 	'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo <i class="fa fa-search"></i>', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Link/Lattes', 'Ações'],
	// 	'select'  => [' id', 'titulo', 'nome', 'email', 'link'],
	// 	'from'    => 'orientador',
	// 	'search'  => ['id', 'titulo', 'nome', 'email']
	// ];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Ações'],
		'from'    => 'orientador',
	];

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

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

		// debug2($dados);
		// debug2($where);
		// exit;

		$orientador = [
			'pessoa'     => [
				'orientador' => $dados['pronome'],
				'nome'       => str_replace(end(explode(' ', $dados['nome'])), '', $dados['nome']),
				'sobrenome'  => end(explode(' ', $dados['nome'])),
				'link'       => $dados['link'],
				'orientador' => 1,
			],
			'usuario'    => [
				'email'      => $dados['email'],
				'hierarquia' => 10,
			],
		];

		$controller_usuario = $this->get_controller('usuario');
		$orientador         = $controller_usuario->insert_update($orientador, $where);

		return $orientador;
	}

	public function middle_editar($id){
		$cadastro = $this->model->load_cadastro($id)[0];
		$this->view->assign('cadastro', $cadastro);
	}










	public function middle_delete($id) {
		$orientador_utilizado = $this->model->query->select('
				rel_orientador.id_orientador,
				rel_orientador.id_trabalho
			')
			->from('trabalho_relaciona_orientador rel_orientador')
			->where("rel_orientador.id_orientador = {$id[0]}")
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

		$retorno = $this->model->delete($this->modulo['modulo'], ['id' => $id[0]]);

		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' removido com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}

	public function buscar_orientador_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_orientador($busca);

		if(empty($retorno)){
			$retorno = [];
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