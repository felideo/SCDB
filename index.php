<?php

require 'config.php';
require 'util/Auth.php';
require 'util/funcoes.php';

// spl_autoload_register

function autoload($className) {

	// debug2($className);
	$indices = explode('_', $className);

	$className = ltrim($className, '\\');
	$fileName  = '';
	$namespace = '';

	if ($lastNsPos = strrpos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}

	debug2($indices);

	if(count($indices) != 3) {
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	} else {
		$fileName .= str_replace('Models\\', '', $indices[0]) . '_' . $indices[1] . '_' . strtolower($indices[2]) . '.php';
	}

	debug2($fileName);

	require $fileName;
}

spl_autoload_register('autoload');

$lib = new Libs\Bootstrap();
