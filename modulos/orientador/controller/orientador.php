<?php
namespace Controller;

use Libs;

class Orientador extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'orientador',
		'name'		=> 'Orientadores',
		'send'		=> 'Orientador'
	];

	// protected $datatable = [
	// 	'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo <i class="fa fa-search"></i>', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Link/Lattes', 'Ações'],
	// 	'select'  => [' id', 'titulo', 'nome', 'email', 'link'],
	// 	'from'    => 'orientador',
	// 	'search'  => ['id', 'titulo', 'nome', 'email']
	// ];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Link/Lattes', 'Ações'],
		'select'  => [' id', 'nome', 'email', 'link'],
		'from'    => 'orientador',
		'search'  => ['id', 'nome', 'email']
	];

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				// $item['titulo'],
				$item['nome'],
				$item['email'],
				$item['link'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		return $retorno;
	}

	public function delete($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "deletar");

		$this->check_if_exists($id[0]);

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