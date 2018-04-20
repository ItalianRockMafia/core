<?php
session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
 	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="global/main.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>IRM - DB Checker</title>
	</head>
	<body>


	<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
	<a class="navbar-brand" href="#">ItalianRockMafia</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item">
        	<a class="nav-link" href="main.php">Home</a>
      	</li>
			  <li class="nav-item active">
				<a class="nav-link" href="#">Settings <span class="sr-only">(current)</span></a>

			  </li>
			  <li class="nav-item">
        	<a class="nav-link" href="<?php echo $config->app_url;?>meetup">Events</a>
      			</li>
				  <li class="nav-item">
				<a class="nav-link" href="../emp">EMP</a>
			  </li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
        			<a class="nav-link" href="login.php?logout=1">Logout</a>
      			</li>
		</ul>
	</div>
</nav>
<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php

require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
$config = require "config.php";


$tg_user = getTelegramUserData();

if ($tg_user !== false) {

	$users = json_decode(getCall($config->api_url . "users?transform=1&filter=telegramID,eq," . $tg_user["id"]),true);

	if(empty($users["users"])){
		$postfields = '{
			"telegramID": "' . $tg_user["id"] . '",
			"tgusername": "' . $tg_user["username"] . '",
			"firstname": "' . $tg_user["first_name"] . '",
			"lastname": "' . $tg_user["last_name"] . '"
		}';
		$register = postCall($config->api_url . "users/", $postfields);
		if($register !== null){
			echo "User " . $tg_user["username"] . " with ID " . $tg_user["id"] . " registered as IRM-User " . $register;
		} else {
			echo "<storng>Error</strong> Clould not tegister user.";
		}

	}

	foreach($users["users"] as $user){
		if($tg_user["id"] == $user["telegramID"]){
			echo "Already registred.";
		} 

	}



	$first_name = htmlspecialchars($tg_user['first_name']);
	$last_name = htmlspecialchars($tg_user['last_name']);
	if (isset($tg_user['username'])) {
		$username = htmlspecialchars($tg_user['username']);
    	$html = "<p>You are: <a href=\"https://t.me/{$username}\">{$first_name} {$last_name}</a></p>";
	} elseif(!isset($tg_user['username']) && $tg_user !== false) {
		$html = "<p>You Are: {$first_name} {$last_name}</p>";
	}
	if (isset($tg_user['photo_url'])) {
    	$photo_url = htmlspecialchars($tg_user['photo_url']);
    	$html .= "<img src=\"{$photo_url}\">";

	}

} 
if($tg_user == false) {
	$html = 'You need to <a href="login.php">login</a> first.';
}
echo $html;

?>
	</div>
			</main>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
				</body>
			</html>
