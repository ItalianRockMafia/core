<?php
require_once "global/functions/apicalls.php";
$config = require_once "config.php";
if(isset($_GET['doirm'])){
	$user = $_GET['doirm'];
	$putfields= '{"accessIDFK": 4}';
	$result = putCall($config->api_url . "users/" . $user, $putfields);
	if(is_numeric($result)){
		echo "promoted<br>";
	} else {
		echo "error<br>";
	}
}

if(isset($_GET['bannew'])){
	$user = $_GET['bannew'];
	$putfields= '{"accessIDFK": 1}';
	$result = putCall($config->api_url . "users/" . $user, $putfields);
	if(is_numeric($result)){
		echo "banned<br>";
	} else {
		echo "error<br>";
	}
}

if(isset($_GET['doguest'])){
	$user = $_GET['doguest'];
	$putfields= '{"accessIDFK": 2}';
	$result = putCall($config->api_url . "users/" . $user, $putfields);
	if(is_numeric($result)){
		echo "Guest<br>";
	} else {
		echo "error<br>";
	}
}

echo '<a href="' . $config->app_url . '">Home</a>';