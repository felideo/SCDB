<?php
require 'util/functions.php';
require 'config.php';
require 'util/auth.php';
require 'vendor/autoload.php';

if(empty(DEVELOPER)){
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(0);
}

session_start();
new Framework\BigBang();
