<?php
namespace Controllers;

use Libs;

class Relatorio_Qtd_Consultas extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'relatorio_qtd_consultas',
		'name'		=> 'Relatorio de Quantidade de Consultas',
		'send'		=> 'Relatorio de Quantidade de Consultas'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");
		$this->view->render($this->modulo['modulo'] . '/relatorio_qtd_consultas');
	}

	public function gerar_relatorio_qtd_consultas(){
		$periodo = carregar_variavel('relatorio_qtd_consultas');

		$dados_relatorios = $this->model->gerar_relatorio_qtd_consultas($periodo);

		$now = new \DateTime('NOW');

		$csv = new Libs\RelatorioCSV();
        $csv->setColunas(
            [
                'ID',
                'Paciente',
                'N° Consultas',
                'Periodo'
            ]
        )
        ->setDados($dados_relatorios)
        ->setFileName('relatorio_quantidade_consultas_paciente_' . $now->format('Y-m-d'))
        ->gerarDocumento();

        exit;
	}
}