<?php
session_start();
$config = require 'config.php';
require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
require 'global/functions/irm.php';
require 'global/functions/header.php';
require 'global/functions/footer.php';

$tg_user = getTelegramUserData();
saveSessionArray($tg_user);

$tgID = $tg_user["id"];
$firstname = $tg_user["first_name"];
$lastname = $tg_user["last_name"];
$username = $tg_user["username"];

$menu = renderMenu();
$options['nav'] = $menu;
$options['title'] = "IRM | Home";
$header = getHeader($options);
$footer = renderFooter();
echo $header;
if ($tg_user !== false) {
?>


<div class="topspacer"></div>
<main role="main">
	<div class="container">
	
				<div class="list-group">
				<?php
					$isIRM = checkIrmUser($tgID);
					if(!$isIRM){
						echo '<a href="checker.php" class="list-group-item list-group-item-action">Register in IRM Database</a>';
					} else {
						echo '<a href="checker.php" class="list-group-item list-group-item-action">Check status in IRM Database</a>';
					}

				?>
  					<a href="settings.php" class="list-group-item list-group-item-action">Settings</a>
						<a href="<?php echo $config->app_url;?>meetup" class="list-group-item list-group-item-action">Events</a>
						<a href="<?php echo $config->app_url;?>emp" class="list-group-item list-group-item-action">EMP-Orders</a>
						<a href="<?php echo $config->app_url;?>vinyl" class="list-group-item list-group-item-action">IRM Record Library</a>
				</div>



<?php


} else {
	echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> You need to <a href="login.php>login</a> first
  </div>
';
}

echo $footer;
?>
			