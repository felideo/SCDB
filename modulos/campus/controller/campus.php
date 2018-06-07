<?php
namespace Controller;

use Libs;

class Campus extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'campus',
		'name'		=> 'Campi',
		'send'		=> 'Campus'
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Campus <i class="fa fa-search"></i>', 'Ações'],
		'select'  => ['id', 'campus'],
		'from'    => 'campus',
		'search'  => ['id', 'campus']
	];

	public function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['campus'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		return $retorno;
	}

	public function delete($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "deletar");

		$this->check_if_exists($id[0]);

		$campus_utilizado = $this->model->query->select('
				trabalho.id
			')
			->from('trabalho trabalho')
			->where("trabalho.id_campus = {$id[0]}")
			->fetchArray();

		if(!empty($campus_utilizado)){
			$msg = 'O campus esta relacionado ao(s) trabalho(s) ID numero: ';

			foreach($campus_utilizado as $indice => $trabalho){
				$msg .= $trabalho['id'] . ', ';
			}

			$msg = rtrim($msg, ', ');
			$msg .= '. Exclusão negada! Remova manualmente este campus de todos os trabalhos antes de tentar excluir-lo.';

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

	public function buscar_campus_select2(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->buscar_campus($busca);

		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			$add_cadastro[0] = [
				'id'               => $busca['nome'],
				'campus'             => "<strong>Cadastrar Novo campus: </strong>" . $busca['nome']
			];

			$retorno = array_merge($add_cadastro, $retorno);
		}

		echo json_encode($retorno);
		exit;
	}
}