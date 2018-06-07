<?php
require 'util/functions.php';
require 'config.php';
require 'util/auth.php';
require 'vendor/autoload.php';

if(empty(DEVELOPER)){
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(0);
}else{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

session_start();
new Framework\BigBang();
