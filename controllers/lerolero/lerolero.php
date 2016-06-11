<?php
namespace Controllers;

use Libs;

class Lerolero extends \Libs\Controller {
	function __construct() {
		parent::__construct();
	}

	public function index() {
		echo "Funcionou fique feliz!!!";
	}

	public function jose(){
		echo "Nivel 0 <br> Funcionou fique feliz!!!";
	}

}