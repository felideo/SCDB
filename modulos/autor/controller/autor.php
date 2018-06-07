<?php
namespace Controller;

use Libs;

class Autor extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'autor',
		'name'		=> 'Autores',
		'send'		=> 'Autor'
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Nome <i class="fa fa-search"></i>', 'Email <i class="fa fa-search"></i>', 'Link/Lattes', 'Ações'],
		'select'  => ['id', 'nome', 'email', 'link'],
		'from'    => 'autor',
		'search'  => ['id', 'nome', 'email']
	];

	protected $datatable_trabalhos_relacionados = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo <i class="fa fa-search"></i>', 'Ações'],
		'select'  => ['id', 'titulo'],
		'from'    => 'trabalho',
		'search'  => ['id', 'titulo']
	];

	public function carregar_listagem_trabalhos_relacionados_ajax($busca, $where = null){
		$query = $this->model->carregar_listagem($busca, $this->datatable_trabalhos_relacionados, $where);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['titulo'],
				$this->view->default_buttons_listagem($item['id'], true, true, true, 'trabalho')
			];
		}

		return $retorno;
	}

	public function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			// $botao_relacionados = \Util\Permission::check_user_permission($this->modulo['modulo'], "visualizar") ?
			// 	"<a href='/{$this->modulo['modulo']}/listagem_trabalhos_relacionados/{$item['id']}' title='Trabalhos Relacionados'><i class='botao_listagem fa fa-book fa-fw'></i></a>" :
			// 	'';

			$retorno[] = [
				$item['id'],
				$item['nome'],
				$item['email'],
				$item['link'],
				// $this->view->default_buttons_listagem($item['id'], true, true, true) . $botao_relacionados
				$this->view->default_buttons_listagem($item['id'], true, true, true)

			];
		}

		return $retorno;
	}

	public function delete($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "deletar");

		$this->check_if_exists($id[0]);

		$autor_utilizado = $this->model->query->select('
				rel_autor.id_autor,
				rel_autor.id_trabalho
			')
			->from('trabalho_relaciona_autor rel_autor')
			->where("rel_autor.id_autor = {$id[0]}")
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

		$retorno = $this->model->delete($this->modulo['modulo'], ['id' => $id[0]]);

		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' removido com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
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