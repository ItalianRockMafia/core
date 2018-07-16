<?php
session_start();
if(!isset($_COOKIE['referer'])){
	setcookie('referer', $_SERVER['HTTP_REFERER']);
	echo $_COOKIE['referer'];
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
 	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="global/main.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>IRM - Login</title>
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
				<a class="nav-link" href="#">Login <span class="sr-only">(current)</span></a>
			  </li>
			
		</ul>
	</div>
</nav>
<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php

define('BOT_USERNAME', 'irmbot'); // place username of your bot here

require_once 'global/functions/telegram.php';
if ($_GET['logout']) {
	setcookie('tg_user', '');
	setcookie('referer', '', time() - 3600);
  header('Location: login.php');
}

$tg_user = getTelegramUserData();
if ($tg_user !== false) {
  header('Location: index.php');
} else {
  $bot_username = BOT_USERNAME;
  $html = <<<HTML
<h1>Please login:</h1>
<script async src="https://telegram.org/js/telegram-widget.js?3" data-telegram-login="{$bot_username}" data-size="large" data-auth-url="<?php echo $config->app_url; ?>check.php" <script async src="https://telegram.org/js/telegram-widget.js?3" data-telegram-login="irmbot" data-size="large" data-auth-url="<?php echo $config->app_url; ?>check.php" data-request-access="write"></script>
HTML;
}


  echo <<<HTML

<center>{$html}


</center>
<div class="topspacer"></div>

<center>
<a href="https://github.com/ItalianRockMafia/core/blob/master/README.md"><button type="button" class="btn btn-success">Hilfe</button></a>
<a href="https://github.com/ItalianRockMafia/core/issues/"><button type="button" class="btn btn-success">Bekannte Bugs</button></a>
<a href="https://github.com/ItalianRockMafia/core/issues/new/"><button type="button" class="btn btn-danger">Neuer Bug erfassen</button></a>
</center>

</div></div></body>
</html>
HTML;

?>