<?php
/**
 * Check if current user is in IR;-DB
 * 
 * This functions checks if a telegram user is recorded in the IRM-DB.
 * 
 * @param string $telegramID Telegram ID from a user to check
 * @return bool true if IRM user, false if not
 *
 * @author Jonas Hüsser
 *
 *
 * @since 0.1
 */

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

/**
 * Save $_SESSION array
 * 
 * This functions saves all important session values
 * 
 * @param  $tg_user array telegram user data provided by telegram login widget
 * @return void
 *
 * @author Jonas Hüsser
 *
 *
 * @since 0.1
 */
function saveSessionArray($tg_user){
	global $config;
	$irmarray = json_decode(getCall($config->api_url . "userStation?transform=1&filter=telegramID,eq," . $tg_user['id']),true);	
	$_SESSION['tgID'] = $tg_user['id'];
	foreach($irmarray['userStation'] as $irm_user){
	$_SESSION['irmID'] = $irm_user['userID'];
	$_SESSION['station'] = $irm_user['station'];
	$_SESSION['public_transport'] = $irm_user['public_transport'];
	}
	$detailarray =  json_decode(getCall($config->api_url . "users/" . $_SESSION['irmID']),true);
	$_SESSION['access'] = $detailarray['accessIDFK'];	
	$_SESSION['username'] = $tg_user['username'];
	$_SESSION['firstname'] = $tg_user['first_name'];
	$_SESSION['lastname'] = $tg_user['last_name'];
}