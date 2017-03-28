<?php
namespace Util;
use Libs;

class URL {
	public static function modulo_url($url) {
		$url = explode('/', $url);
		return $url;
	}
}