<?php
session_start();

$config = require "config.php";
require 'global/functions/apicalls.php';
$userID = $_SESSION['irmID'];
if(isset($_GET['upatestation'])){

	$stationID = $_POST['station'];
	$publictransport = $_POST['publictransport'];
	if(!isset($publictransport)){
		$publictransport = "0";
	}
	$postfields = "{\n \"stationIDFK\": \"$stationID\", \n \"public_transport\": \"$publictransport\" \n}";
	putCall($config->api_url . "users/" . $userID, $postfields);
	header('Location: settings.php');


}

if(isset($_GET["addstation"])){
	$station = $_POST['newStation'];
	$postfields = "{\n \"station\": \"$station\" \n}";
	postCall($config->api_url ."stations", $postfields);
	$postfields = "{\n \"stationIDFK\": \"$stationID\" \n}";
	putCall($config->api_url . "users/" . $userID, $postfields);
	header('Location: settings.php');
	

}


