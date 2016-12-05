<?php
namespace Controllers;

use Libs;

class Relatorio_Pacientes extends \Libs\Controller {

	private $modulo = [
		'modulo' 	=> 'relatorio_pacientes',
		'name'		=> 'Relatorio de Pacientes',
		'send'		=> 'Relatorio de Pacientes'
	];

	function __construct() {
		parent::__construct();
		\Util\Auth::handLeLoggin();

		$this->view->modulo = $this->modulo;
	}

	public function index() {
		\Util\Permission::check($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar");
		$this->view->bateria_list = $this->model->load_active_list('bateria');
		$this->view->render($this->modulo['modulo'] . '/relatorio_pacientes');
	}

	public function gerar_relatorio_pacientes(){
		$bateria = carregar_variavel('id_bateria');
		$dados_relatorios = $this->model->gerar_relatorio_pacientes($bateria);

		$now = new \DateTime('NOW');

		$csv = new Libs\RelatorioCSV();
        $csv->setColunas(
            [
                'Paciente',
                'Pai',
                'Mãe',
                'Sexo',
                'Nascimento',
                'Patologia',
                'Ficha Clinica',



            ]
        )
        ->setDados($dados_relatorios)
        ->setFileName('relatorio_quantidade_consultas_paciente_' . $now->format('Y-m-d'))
        ->gerarDocumento();

        exit;
	}
}