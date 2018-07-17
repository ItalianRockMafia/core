<?php
require_once "global/functions/apicalls.php";
if(isset($_GET['doirm'])){
	$user = $_GET['doirm'];
	$putfields= '{accessIDFK: 4}';
	$result = putCall($config->api_url . "users/" . $user, $putfields);
	if(is_numeric($result)){
		echo "promoted";
	} else {
		echo "error";
	}
}

if(isset($_GET['bannew'])){
	$user = $_GET['bannew'];
	$putfields= '{accessIDFK: 1}';
	$result = putCall($config->api_url . "users/" . $user, $putfields);
	if(is_numeric($result)){
		echo "promoted";
	} else {
		echo "error";
	}
}

echo '< href="' . $config->app_url . '">Home</a>';