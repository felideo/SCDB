<?php
require 'util/functions.php';
require 'config.php';
require 'util/auth.php';
require 'vendor/autoload.php';

session_start();

$lib = new Libs\Bootstrap\Bootstrap();
