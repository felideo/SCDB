<?php
// Configuração do Fuso Horário
date_default_timezone_set('America/Sao_Paulo');

// Sempre use barra (/) no final das URLs
define('URL', 'http://swdb.localhost');
// define('URL', 'http://leaflivedb.felideo.com.br/');


define('LIBS', 'libs/');

// Configuração com Banco de Dados
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'SWDB');
define('DB_USER', 'root');
define('DB_PASS', 'lilith');

define('DEVELOPER', true);
define('PREVENT_CACHE', true);

define('APP_NAME', 'Scientific Work DB');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (function_exists('xdebug_disable')){
	xdebug_disable();
}

