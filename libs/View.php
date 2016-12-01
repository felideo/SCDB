<?php
namespace Libs;

/**
*	classe View
*/
class View {
	function __construct(){
	}

	public function render($name, $noInclude = false) {
		if($noInclude == true){
			require 'views/' . $name . '.php';
		} else {
			require 'views/render/render/header.php';
			require 'views/' . $name . '.php';
			require 'views/render/render/footer.php';
		}
	}

	public function clean_render($name) {
		require 'views/render/clean_render/header.php';
		require 'views/' . $name . '.php';
		require 'views/render/clean_render/footer.php';
	}

	public function sub_render($name, $name_2 = null) {
		if(!is_null($name_2)){
			require 'views/render/render/header.php';
			require 'views/' . $name . '/' . $name_2 . '.php';
			require 'views/render/render/footer.php';
		} else {
		 	require 'views/render/render/header.php';
			require 'views/' . $name . '/' . $name . '.php';
			require 'views/render/render/footer.php';
		}
	}

	public function set_colunas_datatable($colunas){

		foreach ($colunas as $indice => $coluna) {
			if($indice == 0){
				$retorno_coluna[] = "<th aria-sort='ascending' colspan='1' rowspan='1' tabindex='0' class='sorting_asc'>{$coluna}</th>";
			} else {
				$retorno_coluna[] = "<th colspan='1' rowspan='1' tabindex='0' class='sorting'>{$coluna}</th>";

			}
		}

		$this->colunas_datatable = $retorno_coluna;
	}

	public function alert_js($mensagem, $status){
		switch ($status) {
			case 'atencao':
				$status = 'warning';
				$title = "Atenção!";
				break;

			case 'erro':
				$status = 'error';
				$title = "Erro!";
				break;

			case 'sucesso':
				$status = 'success';
				$title = "Sucesso!";
				break;

			case 'info':
				$status = 'info';
				$title = "Info!";
				break;
		}

		$_SESSION['alertas'] = ""
			. " 	swal({\n"
			. "			title: '{$title}',\n"
			. "  		\ttext: '{$mensagem}',\n"
			. "  		\ttype: '{$status}',\n"
			. "  		\tconfirmButtonText: 'OK'\n"
			. "		},\n"
			. " 	\tfunction(){\n"
			. "			console.log('lerolero');\n"
			. " 		\t$.ajax({\n"
			. "			\turl: 'master/limpar_alertas_ajax',\n"
			. " 		\tsuccess: function(retorno){\n"
			. "				\tconsole.log(retorno);\n"
			. "   		\t}\n"
			. "		\t})\n"
			. "		});";
	}

	public function lazy_view(){
		$visualizar = ""
		. "\n<script type='text/javascript'>"
		. "\n    $(window).load(function(){"
		. "\n        $('#lazy_view :input').each(function(){"
		. "\n            $(this).prop('disabled', true);"
		. "\n        });"
		. "\n"
		. "\n        $('.voltar').each(function(){"
		. "\n            $('.btn-success').hide();"
		. "\n            $(this).prop('disabled', false);"
		. "\n            $(this).show();"
		. "\n            $(this).html('Voltar');"
		. "\n        });"
		. "\n"
		. "\n        $('#modulo').removeAttr('action');"
		. "\n"
		. "\n        $('.btn.btn-primary').remove();"
		. "\n    });"
		. "\n</script>";

		echo $visualizar;
	}

	public function default_buttons_listagem($id){
		$url = URL;

		$botao_visualizar = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar") ?
			"<a href='{$url}{$this->modulo['modulo']}/visualizar/{$id}' title='Visualizar'><i class='fa fa-eye fa-fw'></i></a>" :
			'';

		$botao_editar = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar") ?
			"<a href='{$url}{$this->modulo['modulo']}/editar/{$id}' title='Editar'><i class='fa fa-pencil fa-fw'></i></a>" :
			 '';
		$botao_excluir = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar") ?
			"<a href='{$url}{$this->modulo['modulo']}/delete/{$id}' title='Deletar'><i class='fa fa-trash-o fa-fw'></i></a>" :
			'';

		return $botao_visualizar . $botao_editar . $botao_excluir;
	}

}