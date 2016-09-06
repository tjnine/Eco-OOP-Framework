<?php
ob_start();
session_start();

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
	require_once '../classes/' . $class . '.php';
});

require_once '../functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', ['hash', '=', $hash]);
		if($hashCheck->count()) {
			$user = new User($hashCheck->first()->user_id);
			$user->login();
		}
}
