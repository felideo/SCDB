<?php
namespace Controller;

use Libs;

class Busca extends \Framework\ControllerCrud {

	protected $modulo = [
		'modulo' 	=> 'busca',
		'name'		=> 'Busca',
		'send'		=> 'Buscar'
	];

	public function index() {
		$front_controller = $this->get_controller('front');
		$front_controller->carregar_cabecalho_rodape();

		$query = carregar_variavel('query');



		$this->view->assign('query', $query);
		$this->view->assign('anos', $this->carregar_anos());
		$this->view->render('front/cabecalho_rodape', $this->modulo['modulo'] . '/view/front/busca');
	}

	public function carregar_anos(){
		$anos = [];

		foreach($this->model->db->select("SELECT ano FROM trabalho GROUP BY ano") as $indice => $ano){
			$anos[] = [
				'id' => $ano['ano'],
				'text' => $ano['ano']
			];
		}

		return $anos;
	}

	public function buscar(){
		$elastic_search = new \Libs\ElasticSearch\ElasticSearch();

    	$termo = 'popularmente';

		$retorno = $elastic_search->pesquisar_conteudo_documentos($termo);


		debug2($retorno);
		exit;

	}

	public function buscar_taxonomia_select2(){
		$busca       = carregar_variavel('busca');
		$taxon_model = $this->load_external_model('taxon');
		$retorno     = $taxon_model->buscar_taxon($busca);

		echo json_encode($retorno);
		exit;
	}

	public function buscar_nome_popular_select2(){
		$busca           = carregar_variavel('busca');
		$organismo_model = $this->load_external_model('organismo');
		$retorno         = $organismo_model->buscar_nome_popular($busca);

		echo json_encode($retorno);
		exit;
	}



	public function buscar_hierarquia_ajax(){
		$busca = carregar_variavel('id_clado');

		echo json_encode($this->model->buscar_hierarquia($busca));
		exit;
	}

	public function efetuar_busca(){
		$busca = carregar_variavel('busca');

		$retorno = $this->model->efetuar_busca($busca);

		ob_clean();

		echo json_encode($retorno);
		exit;
	}



}