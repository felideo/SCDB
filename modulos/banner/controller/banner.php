<?php
namespace Controller;

use Libs;

class Banner extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'banner',
		'name'		=> 'Banners',
		'send'		=> 'Banner'
	];

	protected $datatable = [
		'colunas' => ['ID', 'Ordem <i class="fa fa-search"></i>', 'Imagem <i class="fa fa-search"></i>', 'Ações'],
		'select'  => ['id', 'ordem', 'id_arquivo'],
		'from'    => 'banner',
		'search'  => ['id', 'ordem', 'id_arquivo']
	];

	protected function carregar_dados_listagem_ajax($busca){
		$query = $this->model->carregar_listagem($busca, $this->datatable);

		$retorno = [];

		foreach ($query as $indice => $item) {
			$retorno[] = [
				$item['id'],
				$item['ordem'],
				$item['arquivo'][0]['nome'],
				$this->view->default_buttons_listagem($item['id'], true, false, true)
			];
		}

		return $retorno;
	}

	public function visualizar($id){
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "visualizar");

		$this->check_if_exists($id[0]);

		$this->view->assign('cadastro', $this->model->carregar_banner($id[0])[0]);

		$this->view->lazy_view();
		$this->view->render('back/cabecalho_rodape_sidebar', $this->modulo['modulo'] . '/view/form/form');
	}

	public function delete($id) {
		\Util\Auth::handLeLoggin();
		\Util\Permission::check($this->modulo['modulo'], "deletar");

		$this->check_if_exists($id[0]);

		$banner = $this->model->full_load_by_id($this->modulo['modulo'], $id[0])[0];

		$retorno = $this->model->delete($this->modulo['modulo'], ['id' => $id[0]]);
		$this->model->delete('arquivo', ['id' => $banner['id_arquivo']]);

		if($retorno['status']){
			$this->view->alert_js(ucfirst($this->modulo['modulo']) . ' removido com sucesso!!!', 'sucesso');
		} else {
			$this->view->alert_js('Ocorreu um erro ao efetuar a remoção do ' . strtolower($this->modulo['modulo']) . ', por favor tente novamente...', 'erro');
		}

		header('location: /' . $this->modulo['modulo']);
	}



}