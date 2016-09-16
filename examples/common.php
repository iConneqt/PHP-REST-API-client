<?php

/**
 * This file contains code that is required by all the examples
 */
require_once __DIR__ . '/../src/autoloader.php';

$file = __DIR__ . '/auth.ini';
if (file_exists($file)) {
	foreach (parse_ini_file($file) as $key => $value) {
		define('ICONNEQT_' . strtoupper($key), $value);
	}
} else {
	die("Please copy the auth.example.ini file to auth.ini and set your username and password.");
}