<?php
namespace Controller;

use Libs;

class Permissao extends \Libs\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'permissao',
		'name'		=> 'Permissão',
		'send'		=> 'Permissão'
	];

	protected $datatable = [
		'colunas' => ['ID', 'Modulo', 'Permissão', 'Ações'],
		'select'  => ['id', 'id_modulo', 'permissao'],
		'from'    => 'permissao',
		'search'  => ['id', 'id_modulo', 'permissao']
	];


	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['modulo'][0]['nome'],
				$item['permissao'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
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

		echo json_encode($retorno);
		exit;
	}
}