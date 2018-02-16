<?php
session_start();

require 'global/functions/telegram.php';
require 'global/functions/apicalls.php';
$config = require "config.php";

$users = json_decode(getCall($config->api_url . "users?transform=1"), true);

$userids = array();
foreach($users["users"] as $user){
array_push($userids, $user["telegramID"]);
}

$tg_user = getTelegramUserData();
if ($tg_user !== false && in_array($tg_user["id"], $userids)) {
	header('Location: main.php');

}elseif ($tg_user !== false && !in_array($tg_user["id"], $userids)) {
	header('Location: public.html');
}else{
	header('Location: login.php');
	}

