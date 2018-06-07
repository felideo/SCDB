<?php
namespace Controller;

use Libs;

class Pagina_institucional extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'pagina_institucional',
		'name'		=> 'Paginas Institucionais',
		'send'		=> 'Pagina Institucional'
	];

	protected $datatable = [
		'colunas' => ['ID <i class="fa fa-search"></i>', 'Titulo <i class="fa fa-search"></i>', 'Ações'],
		'select'  => ['id', 'titulo'],
		'from'    => 'pagina_institucional',
		'search'  => ['id', 'titulo']
	];

	public function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['titulo'],
				$this->view->default_buttons_listagem($item['id'], true, true, true)
			];
		}

		return $retorno;
	}
}
