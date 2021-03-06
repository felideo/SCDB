<?php
namespace Controller;

use Libs;

class Palavra_chave extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' => 'palavra_chave',
		'name'   => 'Palavras Chaves',
		'send'   => 'Palavra Chave',
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Palavra Chave <i class="fa fa-search"></i>', 'Ações'],
		'select'  => ['id', 'palavra_chave'],
		'from'    => 'palavra_chave',
		'search'  => ['id', 'palavra_chave'],
		'ordenacao_desabilitada' => '2'
	];

	public function carregar_listagem_ajax(){
		$busca = [
			'order'  => carregar_variavel('order'),
			'search' => carregar_variavel('search'),
			'start'  => carregar_variavel('start'),
			'length' => carregar_variavel('length'),
		];

		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['palavra_chave'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		echo json_encode([
            "draw"            => intval(carregar_variavel('draw')),
            "recordsTotal"    => intval(count($retorno)),
            "recordsFiltered" => intval($this->model->select("SELECT count(id) AS total FROM {$this->modulo['modulo']} WHERE ativo = 1")[0]['total']),
            "data"            => $retorno
        ]);

		exit;
	}

	public function middle_delete($id) {
		$palavra_chave_utilizado = $this->model->query->select('
				rel_palavra.id_palavra_chave,
				rel_palavra.id_trabalho
			')
			->from('trabalho_relaciona_palavra_chave rel_palavra')
			->where("rel_palavra.id_palavra_chave = {$id}")
			->fetchArray();

		if(!empty($palavra_chave_utilizado)){
			$msg = 'A palavra chave esta relacionada ao(s) trabalho(s) ID numero: ';

			foreach($palavra_chave_utilizado as $indice => $trabalho){
				$msg .= $trabalho['id_trabalho'] . ', ';
			}

			$msg = rtrim($msg, ', ');
			$msg .= '. Exclusão negada! Remova manualmente esta palavra chave de todos os trabalhos antes de tentar excluir-la.';

			$this->view->alert_js($msg, 'erro');
			header('location: /' . $this->modulo['modulo']);
			exit;
		}

		return $this->model->delete($this->modulo['modulo'], ['id' => $id]);
	}

	public function buscar_palavra_chave_select2(){
		$busca = carregar_variavel('busca');
		$retorno = $this->model->buscar_palavra_chave($busca);


		if(isset($busca['cadastrar_busca']) && !empty($busca['cadastrar_busca']) && $busca['cadastrar_busca'] == 'true' && $busca['nome'] != '%%'){
			if(empty($retorno)){
				$retorno = [];
			}

			$add_cadastro[0] = [
				'id'            => $busca['nome'],
				'palavra_chave' => "<strong>Cadastrar Nova Palavra Chave: </strong>" . $busca['nome']
			];

			$retorno = array_merge($add_cadastro, $retorno);
		}

		if(empty($retorno)){
			$retorno = false;
		}

		echo json_encode($retorno);
		exit;

	}
}