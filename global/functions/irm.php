<?php


function checkIrmUser($telegramID){
	global $config;
	$users = json_decode(getCall($config->api_url . "users?transform=1"), true);
	
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
	
	return $result;


}


function saveSessionArray($tg_user){
	global $config;
	$irmarray = json_decode(getCall($config->api_url . "users?transform=1&filter=telegramID,eq," . $tg_user['id']),true);	
	$_SESSION['tgID'] = $tg_user['id'];
	foreach($irmarray['users'] as $irm_user){
	$_SESSION['irmID'] = $irm_user['userID'];
	}
	$_SESSION['username'] = $tg_user['username'];
	$_SESSION['firstname'] = $tg_user['first_name'];
	$_SESSION['lastname'] = $tg_user['last_name'];
}