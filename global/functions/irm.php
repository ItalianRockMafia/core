<?php


function checkIrmUser($telegramID){
	$users = json_decode(getCall("https://api.italianrockmafia.ch/api.php/users?transform=1"), true);
	
	$userids = array();
	foreach($users["users"] as $user){
	array_push($userids, $user["telegramID"]);
	}
	$tg_user = getTelegramUserData();

	if ($tg_user !== false && in_array($tg_user["id"], $userids)) {
		$result = true;
	
	}elseif ($tg_user !== false && !in_array($tg_user["id"], $userids)) {
		$result = false;
	
	}else{
		header('Location: login.php');
		die();
		}
	
	


}