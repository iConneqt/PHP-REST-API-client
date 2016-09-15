<?php

/**
 * This file contains code that is required by all the examples
 */

define('EXAMPLE_URL', 'https://demo.iconneqt.nl');
define('EXAMPLE_USERNAME', 'restapiuser');
define('EXAMPLE_PASSWORD', 'fCFv6N3Ayz9faW7MGqkguW7');

spl_autoload_register(function ($classname) {
	$file = dirname(__DIR__) . '/src/' . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
	if (file_exists($file)) {
		require_once $file;
	}
});
