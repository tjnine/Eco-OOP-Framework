<?php 
include '../includes/info.php';
include '../includes/settings.php';
include '../includes/helpers.php';

$GLOBALS['config'] = [
	'mysql' => [
		'host' => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'database' => 'octane'
	],
	'remember' => [
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	],
	'session' => [
		'session_name'  =>	'user',
		'token_name'	=>	'token'	
	]
];

spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});

?>