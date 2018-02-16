<?php
session_start();

$config = require "config.php";
require 'global/functions/apicalls.php';
if(isset($_GET['upatestation'])){

	$stationID = $_POST['station'];
	$userID = $_SESSION['irmID'];
	$postfields = "{\n \"stationIDFK\": \"$stationID\" \n}";
	putCall($config->api_url . "users/" . $userID, $postfields);
	header('Location: settings.php');


}

if(isset($_GET["addstation"])){
	//add & link
}


