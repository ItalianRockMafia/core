<?php
session_start();
header('HTTP/1.0 401 Unauthorized');
$config = require_once 'config.php';
require_once 'global/functions/apicalls.php';
require_once 'global/functions/telegram.php';
require_once 'global/functions/irm.php';

$tg_user = getTelegramUserData();
saveSessionArray($tg_user);

$tgID = $tg_user["id"];
$firstname = $tg_user["first_name"];
$lastname = $tg_user["last_name"];
$username = $tg_user["username"];

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
 	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="global/main.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>IRM - Settings</title>
	</head>
	<body>


	<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
	<a class="navbar-brand" href="#">ItalianRockMafia</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
        				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      				</li>
			  <li class="nav-item">
				<a class="nav-link" href="settings.php">Settings</a>
			  </li>
				<li class="nav-item">
        	<a class="nav-link" href="<?php echo $config->app_url;?>meetup">Events</a>
      	</li>
		  <li class="nav-item">
        				<a class="nav-link" href="<?php echo $config->app_url; ?>emp">EMP</a>
      				</li>
					  <li class="nav-item">
        				<a class="nav-link" href="<?php echo $config->app_url; ?>vinyl">Vinyls</a>
      				</li>
				</ul>
				<?php 
				if ($tg_user !== false) {
					echo '
				<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
        			<a class="nav-link" href="login.php?logout=1">Logout</a>
      			</li>
		</ul>';
				 } ?>
	</div>
</nav>
<div class="topspacer"></div>
<main role="main">
	<div class="container">
	
				<h1><strong>Error 401:</strong> Unauthorized</h1>
				<p>You need to authenticate yourself.</p>
				<a href="https://italianrockmafia.ch/login.php" class="btn btn-success">Login</a>
				<a href="https://italianrockmafia.ch/" class="btn btn-success">Homepage</a>



		</div>
			</main>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
				</body>
			</html>
