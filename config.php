<?php
// Configuração do Fuso Horário
date_default_timezone_set('America/Sao_Paulo');

// Sempre use barra (/) no final das URLs
define('URL', 'http://teste.localhost/felideo_mvc_novo/');
// define('URL', 'http://leaflivedb.felideo.com.br/');


define('LIBS', 'libs/');

// Configuração com Banco de Dados
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'LeafLiveDB');
define('DB_USER', 'root');
define('DB_PASS', 'lilith');

define('DEVELOPER', true);

// define('DB_TYPE', 'mysql');
// define('DB_HOST', 'mysql.hostinger.com.br');
// define('DB_NAME', 'u142129811_lldb');
// define('DB_USER', 'u142129811_lldb');
// define('DB_PASS', 'jsimone1546');

define('APP_NAME', 'LeafLiveDB');

error_reporting(E_ALL);
ini_set('display_errors', 1);