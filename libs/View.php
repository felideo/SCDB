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
}