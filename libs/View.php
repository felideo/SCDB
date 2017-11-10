<?php
namespace Libs;

class View {
	private $dwoo;
	private $assign;

	function __construct(){
		$this->dwoo   = new \Dwoo\Core();
		$this->assign = new \Dwoo\Data();

		$this->assign('app_name', APP_NAME);
		$this->assign('_SESSION', $_SESSION);
	}

	public function assign($index, $data){
		$this->assign->assign($index, $data);
	}

	public function getAssign($data){
		return $this->assign->get($data);
	}



	public function render($header_footer, $body) {
		$template = new \Dwoo\Template\File('modulos/' . $body . '.html');

		if(strpos($header_footer, 'sidebar')){
			$this->mount_sidebar();
		}

		$header = new \Dwoo\Template\File('views/' 		. $header_footer 	. '/header.html');
		$body   = new \Dwoo\Template\File('modulos/' 	. $body 			. '.html');
		$footer = new \Dwoo\Template\File('views/' 		. $header_footer 	. '/footer.html');

		echo $this->dwoo->get($header, $this->assign);
		echo $this->dwoo->get($body, $this->assign);
		echo $this->dwoo->get($footer, $this->assign);

		exit;

		// // debug2(get_defined_vars());
		// // exit;
		// // if(!file_exists('views/' . $header_footer . '/header.php')){
		// // 	$e = new \Exception('Cabeçalho: views/' . $header_footer . '/header.php não existe!');
		// // 	debug2($e->getMessage());
  // //           debug2($e->getTrace());
  // //           exit;
		// // }

		// // if(!file_exists('views/' . $header_footer . '/footer.php')){
		// // 	$e = new \Exception('Rodape: views/render/' . $header_footer . '/footer.php não existe!');
		// // 	debug2($e->getMessage());
  // //           debug2($e->getTrace());
  // //           exit;
		// // }

		// // if(!file_exists('modulos/' . $body . '.php')){
		// // 	$e = new \Exception('View não existe!');
		// // 	debug2($e->getMessage());
  // //           debug2($e->getTrace());
  // //           exit;
		// // }




		// // $this->extra_js = end(explode('/', $body));

		// require 'views/' . $header_footer . '/header.php';
		// require 'modulos/' . $body . '.php';
		// require 'views/' . $header_footer . '/footer.php';
	}

	private function mount_sidebar(){
		$array_menu = [];
		$submenus_com_permissao = [];

		$active = ($_SESSION['modulo_ativo'] == 'painel_controle') ? "active" : " ";

		$array_menu[] = "<li class='{$active}'>\n\t"
			. "<a href='/painel_controle'>\n\t\t"
			. "<span aria-hidden='true' class='fa fa-dashboard fa-fw'></span>\n\t\t"
            . "<span class='nav-label'>Painel de Controle</span>\n\t"
			. "</a>\n"
			. "</li>\n";

		foreach ($_SESSION['menus'] as $indice_01 => $menu){
			if(count($menu) == 1){
				if($_SESSION['usuario']['super_admin'] == 1 || isset($_SESSION['permissoes'][$menu[0]['modulo']])){

						$active = $menu[0]['modulo'] == $_SESSION['modulo_ativo'] ? "active" : " ";

						$string_menu = "<li class=' {$active} '>\n\t"
							. " <a href='/{$menu[0]['modulo']}'>\n\t\t"
							. 		"<span aria-hidden='true' class='icon fa {$menu[0]['icone']} fa-fw'></span>\n\t\t";

							$menu_submenu_nome = isset($menu[0]['submenu']) && !empty($menu[0]['submenu']) ? $menu[0]['submenu'] : $menu[0]['nome'];

                         	$string_menu .= "<span class='nav-label'>{$menu_submenu_nome}</span>\n\t"
	            			. "</a>\n"
	            			. "</li>\n";
	            }
           	}elseif(count($menu) > 1){
				foreach ($menu['modulos'] as $indice_02 => $submenu){
					if($_SESSION['usuario']['super_admin'] == 1 || isset($_SESSION['permissoes'][$submenu['modulo']])){
						$submenus_com_permissao[] = $indice_01;

					}
				}
			}

			if(isset($string_menu)){
				$array_menu[] = $string_menu;
			}

			if(isset($string_menu)){
				unset($string_menu);
			}
		}

		if(!empty($submenus_com_permissao)){
			$submenus_com_permissao = array_unique($submenus_com_permissao);

			foreach ($submenus_com_permissao as $indice_03 => $submenus){
				$active = $menu[0]['modulo'] == $_SESSION['modulo_ativo'] ? "active" : " ";
				$menu_submenu = "<li  class=' {$active} '>\n\t"
         			. " <a href='#'>\n\t\t"
					. 		"<span aria-hidden='true' class='icon fa glyphicon {$_SESSION['menus'][$submenus]['icone']} fa-fw'></span>\n\t\t"
                    . 		"<span class='nav-label'>{$_SESSION['menus'][$submenus]['nome_exibicao']}</span>\n\t\t"
                    .		"<span class='fa arrow'></span>\n\t"
         			. " </a>\n\t"
     				. " <ul class='nav nav-second-level'>\n\t\t";

					foreach($_SESSION['menus'][$submenus]['modulos'] as $indice_04 => $submenu){
						if($_SESSION['usuario']['super_admin'] == 1 || isset($_SESSION['permissoes'][$submenu['modulo']])){
 	                        $menu_submenu .= "<li class=' {$active} '>\n\t\t\t"
                         		. 	" <a href='/{$submenu['modulo']}'>\n\t\t\t\t"
								. 		"<span aria-hidden='true' class='icon fa glyphicon {$submenu['icone']} fa-fw'></span>\n\t\t\t\t"
 	                            . 		"<span class='nav-label'>{$submenu['nome']}</span>\n\t\t\t"
 	                            . 	" </a>\n\t\t"
 	                        	. "</li>\n\t";
						}
					}

                 	$menu_submenu .= "</ul>\n"
         				. "</li>";

        		$array_menu[] = $menu_submenu;
        		unset($menu_submenu);
			}
		}

		$array_menu = implode(' ', $array_menu);

		$this->assign('sidebar_painel_administrativo', $array_menu);
	}

	// public function render($name, $noInclude = false) {
	// 	if($noInclude == true){
	// 		require 'views/' . $name . '.php';
	// 	} else {
	// 		require 'views/render/render/header.php';
	// 		require 'views/' . $name . '.php';
	// 		require 'views/render/render/footer.php';
	// 	}
	// }

	public function clean_render($name) {
		require 'views/render/clean_render/header.php';
		require 'views/' . $name . '.php';
		require 'views/render/clean_render/footer.php';
	}

	public function front_render($name) {
		require 'views/render/front_render/header.php';
		require 'views/' . $name . '.php';
		require 'views/render/front_render/footer.php';
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

		$this->assign('colunas_datatable', $retorno_coluna);
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
			. "			\turl: '/master/limpar_alertas_ajax',\n"
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
		. "\n            $(this).select2('disable');"
		. "\n        });"
		. "\n        $('.lazy_view :input').each(function(){"
		. "\n            $(this).prop('disabled', true);"
		. "\n            $(this).select2('disable');;"
		. "\n        });"
		. "\n"
		. "\n        $('#modulo').removeAttr('action');"
		. "\n"
		. "\n        $('.btn .btn-primary').remove();"

		. "\n        $('.lazy_view_remove').each(function(){"
		. "\n            $(this).remove();"
		. "\n        });"

		. "\n        console.log('lazy_view');"

		. "\n    });"
		. "\n</script>";

		echo $visualizar;
	}

	public function default_buttons_listagem($id, $visualizar = true, $editar = true, $excluir = true){
		$botao_visualizar = '';
		$botao_editar     = '';
		$botao_excluir    = '';

		if($visualizar){
			$botao_visualizar = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "visualizar") ?
				"<a href='/{$this->modulo['modulo']}/visualizar/{$id}' title='Visualizar'><i class='fa fa-eye fa-fw'></i></a>" :
				'';
			}

		if($editar){
			$botao_editar = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "editar") ?
				"<a href='/{$this->modulo['modulo']}/editar/{$id}' title='Editar'><i class='fa fa-pencil fa-fw'></i></a>" :
				 '';
		}

		if($excluir){
			$botao_excluir = \Util\Permission::check_user_permission($this->modulo['modulo'], $this->modulo['modulo'] . "_" . "deletar") ?
				"<a href='/{$this->modulo['modulo']}/delete/{$id}' title='Deletar'><i class='fa fa-trash-o fa-fw'></i></a>" :
				'';
		}

		return $botao_visualizar . $botao_editar . $botao_excluir;
	}

}