<?php

require 'framework/Error.php';
require 'util/functions.php';
require 'config.php';
require 'util/auth.php';
require 'vendor/autoload.php';

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

if(((isset($_SESSION['mostrar_erros']) && !empty($_SESSION['mostrar_erros'])) && $_SESSION['mostrar_erros'] == 'habilitado') || (defined('DEVELOPER')) && !empty(DEVELOPER)){
    error_reporting(E_ALL);
	ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
}

\Libs\Session::init();
new Framework\BigBang();
