<?php 
#General Website Information
$general = [
	'contact' => [
	'title' => 'Contact Page',
	'description' => 'Email Notifications and viewable on Admin Panel.'
	],
	'home' => [
	'title' => 'PHP/EmberJS/Bootstrap Eco Package',
	'description'	=>	'The client side index page of Eco Package.'
	],
	'blog'	=> [
	'title'	=> 'Eco Blog Title',
	'description'	=> 'A simple blog that is setup with the Eco Package using the incredible TinyMCE editor.'
	]
];

#Global Website Information 
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

function Redirect($url, $statusCode = 303) {
	header('Location: ' . $url, true, $statusCode);
	exit();
}


spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});

?>