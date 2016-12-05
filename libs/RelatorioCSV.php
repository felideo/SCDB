<?php
namespace Libs;

class RelatorioCSV {

	private $colunas = [];
	private $dados   = [];
	private $filename;
	private $delimiter;
	private $enclousure;

	public function __construct() {
	}

	public function setColunas(array $colunas) {
		$this->colunas = $colunas;
		return $this;
	}

	public function setDados(array $dados) {
		$this->dados = $dados;
		return $this;
	}

	public function setFileName($filename){
		$this->filename = $filename;
		return $this;
	}

	public function setDelimiter($delimiter){
		$this->delimiter = $delimiter;
		return $this;
	}

	public function setEnclousure($enclousure){
		$this->enclousure = $enclousure;
		return $this;
	}

	public function gerarDocumento() {
        $saida_csv = fopen('php://output','w') or die("Erro ao abrir php://output");

        header('Content-Type: application/csv');
        header("Content-Disposition: attachment; filename='{$this->filename}.csv'");

		$delimiter = !empty($this->delimiter) ? $this->delimiter : ',';
		$enclousure = !empty($this->enclousure) ? $this->enclousure : '"';

        fputcsv($saida_csv, $this->colunas, $delimiter, $enclousure);

        foreach($this->dados as $linha) {
            fputcsv($saida_csv, $linha, $delimiter, $enclousure);
        }

        fclose($saida_csv) or die("Erro ao fechar o arquivo php://output");
        exit;
	}
}