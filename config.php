<?php
// Configuração do Fuso Horário
date_default_timezone_set('America/Sao_Paulo');

$protocolo = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
$url       = $protocolo . $_SERVER['HTTP_HOST'] . '/';

// Sempre use barra (/) no final das URLs
define('URL', $url);

define('LIBS', 'libs/');

// Configuração com Banco de Dados
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

define('DEVELOPER', true);
define('PREVENT_CACHE', true);

define('APP_NAME', 'Scientific Work DB');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (function_exists('xdebug_disable')){
	xdebug_disable();
}