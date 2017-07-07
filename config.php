<?php
// Configuração do Fuso Horário
date_default_timezone_set('America/Sao_Paulo');

// Sempre use barra (/) no final das URLs
define('URL', 'http://leaflivedb.localhost');
// define('URL', 'http://leaflivedb.felideo.com.br/');


define('LIBS', 'libs/');

// Configuração com Banco de Dados
// define('DB_TYPE', 'mysql');
// define('DB_HOST', '127.0.0.1');
// define('DB_NAME', 'LeafLiveDB');
// define('DB_USER', 'root');
// define('DB_PASS', 'lilith');

// define('DB_TYPE', 'mysql');
// define('DB_HOST', 'mysql.hostinger.com.br');
// define('DB_NAME', 'u595159613_leaf');
// define('DB_USER', 'u595159613_leaf');
// define('DB_PASS', '20lilith88');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'gestaoja2-aurora-cluster-1.cluster-cpmpaudst387.us-east-1.rds.amazonaws.com');
define('DB_NAME', 'gestaoja2_basico2');
define('DB_USER', 'diego.felideo');
define('DB_PASS', '64UOfkL3M9ZMK87sjY1T8b40Af993s');


		// $this->db = new \Libs\Database('mysql', 'gestaoja2-aurora-outros.cpmpaudst387.us-east-1.rds.amazonaws.com', 'gestaoja2_basico2', 'diego.felideo', '64UOfkL3M9ZMK87sjY1T8b40Af993s');


define('APP_NAME', 'LeafLiveDB');

error_reporting(E_ALL);
ini_set('display_errors', 1);