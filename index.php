<?php

require 'config.php';
require 'util/auth.php';
require 'util/funcoes.php';


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

	$file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';

	require $file_name;
}

spl_autoload_register('autoload');

require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, ['cache' => 'twig_cache', 'debug' => true]);
$twig->addExtension(new Twig_Extension_Debug());

$lib = new Libs\Bootstrap($twig);