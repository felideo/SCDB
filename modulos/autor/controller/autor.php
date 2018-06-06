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
		'colunas' => ['ID', 'Nome', 'Email', 'Link/Lattes', 'Ações'],
		'select'  => ['id', 'nome', 'email', 'link'],
		'from'    => 'autor',
		'search'  => ['id', 'nome', 'email', 'link']
	];

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
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

		echo json_encode($retorno);
		exit;
	}
}