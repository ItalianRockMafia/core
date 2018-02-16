<?php
session_start();

$config = require "config.php";
if(isset($_GET['upatestation'])){

	$stationID = $_POST['station'];
	$userID = $_SESSION['userID'];




}

if(isset($_GET["addstation"])){
	//add & link
}


