<?php

session_start();
require_once 'global/functions/apicalls.php';
require_once 'global/functions/telegram.php';
require_once 'global/functions/header.php';
require_once 'global/functions/footer.php';
require_once 'global/functions/irm.php';


$config = require_once "config.php";

$tg_user = getTelegramUserData();

$menu = renderMenu();
$options['nav'] = $menu;
$options['title'] = "IRM | Admin";
$header = getHeader($options);
$footer = renderFooter();
echo $header;
?>

<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php
if ($tg_user !== false) {
	$tgID = $tg_user["id"];
	$firstname = $tg_user["first_name"];
	$lastname = $tg_user["last_name"];
	$username = $tg_user["username"];

	saveSessionArray($tg_user);
	$access = $_SESSION['access'];
	if($access >= 6){
		$inactive_users = json_decode(getCall($config->api_url . "inactiveUsers?transform=1"), true);
		if(empty($inactive_users['inactiveUsers'])){
			echo	'
	<div class="alert alert-warning" role="alert">
	<strong>Warning.</strong> No inactive users found.
  </div>
';
		} else {

		foreach($inactive_users['inactiveUsers'] as $inactive_user){
			$iu_irmID = $inactive_user['userID'];
			$iu_tgID = $inactive_user['telegramID'];
			$iu_tgusername = $inactive_user['tgusername'];

			$msgtext = urlencode("<b>You're account has been deleted</b>" . chr(10) . "Hi $iu_tgusername" . chr(10). "Maybe you remember me. I'm from italianrockmafia.ch, 
			where you have registred yourself some time ago." . chr(10) . "During our recent check, we discovered that you're inactive, so we deleted your account, because this isn't a public page." . chr(10) .
			chr(10) . 'If your intrested about the project, visit us on <a href="https://github.com/ItalianRockMafia">GitHub</a>' . chr(10) . chr(10) . "Goodbye!");
			$alertURL = "https://api.telegram.org/bot" . $config->telegram['token'] . "/sendMessage?chat_id=" . $iu_tgID . "&parse_mode=HTML&text=" . $msgtext;
			$endpoint = $config->api_url . "users/" . $iu_irmID;
			$result = deleteCall($endpoint);
			if(is_numeric($result)){
				getCall($alertURL);
				echo '
				<div class="alert alert-success" role="alert">
				<strong>Success!</strong> User ' . $iu_tgusername . ' (' . $iu_tgID . '). with IRM-ID '. $iu_irmID .' has been deleted.
			  </div>
			';
				
			} else {
			echo	'
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> Could not delete user ' . $iu_tgusername . ' (' . $iu_tgID . '). with IRM-ID '. $iu_irmID .'
  </div>
';
			}
		}
		
	}
	} else {
		echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> Access denied
  </div>
';
	}

} else {
	echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> You need to <a href="login.php">login</a> first
  </div>
';
}

echo $footer;
?>
