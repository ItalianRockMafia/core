<?php
session_start();

require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
$config = require "config.php";
require 'global/functions/header.php';
require 'global/functions/footer.php';


$menu = renderMenu();
$options['nav'] = $menu;
$options['title'] = "IRM | User Checker";
$header = getHeader($options);
$footer = renderFooter();
echo $header;
?>

<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php



$tg_user = getTelegramUserData();

//check if user is logged in
if ($tg_user !== false) {

	//get my user info
	$users = json_decode(getCall($config->api_url . "users?transform=1&filter=telegramID,eq," . $tg_user["id"]),true);

	//user is not a IRM user
	if(empty($users["users"])){
		$postfields = '{
			"telegramID": "' . $tg_user["id"] . '",
			"tgusername": "' . $tg_user["username"] . '",
			"firstname": "' . $tg_user["first_name"] . '",
			"lastname": "' . $tg_user["last_name"] . '"
		}';
		//register user in IRM DB
		$register = postCall($config->api_url . "users/", $postfields);
		//show result
		if($register !== null){
			echo "User " . $tg_user["username"] . " with ID " . $tg_user["id"] . " registered as IRM-User " . $register;
		} else {
			echo "<storng>Error</strong> Clould not tegister user.";
		}

	}
	//user is already an irm user
	foreach($users["users"] as $user){
		if($tg_user["id"] == $user["telegramID"]){
			echo "Already registred.";
		} 

	}


//show user info
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
	//user is not logged in
	$html = 'You need to <a href="login.php">login</a> first.';
}
echo $html;

echo $footer;
?>
	