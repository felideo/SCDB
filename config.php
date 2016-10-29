<?php
// Configuração do Fuso Horário
date_default_timezone_set('America/Sao_Paulo');

// Sempre use barra (/) no final das URLs
// define('URL', 'http://teste.localhost/neurosis/');
define('URL', 'http://felideo.com.br/neurosis/');

define('LIBS', 'libs/');

// Configuração com Banco de Dados
// define('DB_TYPE', 'mysql');
// define('DB_HOST', '127.0.0.1');
// define('DB_NAME', 'NeuroSis');
// define('DB_USER', 'root');
// define('DB_PASS', 'lilith');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'mysql.hostinger.com.br');
define('DB_NAME', 'u595159613_neuro');
define('DB_USER', 'u595159613_neuro');
define('DB_PASS', '20lilith88');


define('APP_NAME', 'NeuroSis');

// HASH KEY, nunca mude esta parte, pois é usada para as senhas!
define('HASH_GENERAL_KEY', 'ze4umudrajadr3fracruba834be4utra');

// Isto é apenas para o Banco de Dados
define('HASH_PASSWORD_KEY', 'rexutacuma2rechecre8ucrespujufuc');

// Configuração de Imagens
define('IMG_FOLDER', 'imagens/'); // Pasta das imagens sempre com "/" no final
define('IMG_SIZE', '1000000'); // Tamanho máximo do arquivo em bytes

error_reporting(E_ALL);
ini_set('display_errors', 1);