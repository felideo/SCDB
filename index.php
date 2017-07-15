<?php
require 'util/functions.php';
require 'config.php';
require 'util/auth.php';
require 'vendor/autoload.php';

session_start();

// spl_autoload_register
function autoload($class_name) {
	$class_name = ltrim($class_name, '\\');
	$file_name  = '';
	$namespace = '';

	if ($lastNsPos = strrpos($class_name, '\\')) {
		$namespace = substr($class_name, 0, $lastNsPos);
		$class_name = substr($class_name, $lastNsPos + 1);
		$file_name  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}

	// $file_name = strtolower($file_name);
	$file_name = str_replace('Libs', 'libs', $file_name);
	$file_name = str_replace('Util', 'util', $file_name);



	// $file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
	$file_name .= $class_name . '.php';

	if(file_exists($file_name)){
		require $file_name;
	}
}

spl_autoload_register('autoload');
$lib = new libs\bootstrap();