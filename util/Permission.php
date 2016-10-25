<?php
namespace Util;
use Libs;

class Permission {
	public static function check($modulo, $permissao) {
		if(empty($_SESSION['permissoes'][$modulo]) || empty($_SESSION['permissoes'][$modulo][$permissao])){
			$view = new Libs\View();
			$view->alert_js('Vocã não possui permissão para efetuar esta ação...', 'erro');
			header('location: ' . URL . $modulo);
			exit;
		}
	}
}