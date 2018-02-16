<?php
session_start();
$config = require 'config.php';
require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
require 'global/functions/irm.php';

$tg_user = getTelegramUserData();

$tgID = $tg_user["id"];
$firstname = $tg_user["first_name"];
$lastname = $tg_user["last_name"];
$username = $tg_user["username"];
if ($tg_user !== false) {
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
				<div class="list-group">
				<?php
					$isIRM = checkIrmUser($tgID);

				?>
  					<a href="settings.php" class="list-group-item list-group-item-action">Settings</a>
				</div>



<?php


} else {
	echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> You need to login first
  </div>
';
}
?>
			</div>
		</main>
	</body>
</html>
