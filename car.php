<?php
session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
 	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="global/main.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://use.fontawesome.com/c414fc2c21.js"></script>
		<title>IRM - Settings</title>
	</head>
	<body>


	<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
	<a class="navbar-brand" href="#">ItalianRockMafia</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item">
        				<a class="nav-link" href="main.php">Home</a>
      				</li>
			  <li class="nav-item active">
				<a class="nav-link" href="#">Settings <span class="sr-only">(current)</span></a>
			  </li>
				<li class="nav-item">
        	<a class="nav-link" href="https://italianrockmafia.ch/meetup">Events</a>
      	</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
        			<a class="nav-link" href="login.php?logout=1">Logout</a>
      			</li>
		</ul>
	</div>
</nav>
<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php

require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
$config = require "config.php";


$tg_user = getTelegramUserData();

if ($tg_user !== false) {

	if(isset($_GET['add'])){
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$color = $_POST['color'];
		$licence = $_POST['licence'];
		$seats = $_POST['seats'];
		$owner = $_SESSION['irmID'];
		$postfields = "{\n\t\"brandIDFK\": \"$brand\", \n\t\"modelIDFK\": \"$model\",\n\t\"colorIDFK\": \"$color\",\n\t\"licence\": \"$licence\",\n\t\"seats\": \"$seats\",\n\t\"ownerIDFK\": \"$owner\"\n\t\n}";
		$car = postcall($config->api_url . "cars", $postfields);
		if(is_numeric($car)){
			header('Location: settings.php');
		}
	}

if(isset($_GET['delete'])){
	deleteCall($config->api_url . "cars/" . $_GET['delete']);
	header('Location: settings.php');
}

if(isset($_GET['new'])){
	$new = true;
} elseif(isset($_GET['edit'])){
	$edit = true;
	$car = $_GET['edit'];
	$cardata = json_decode(getCall($config->api_url . "carUsers?transform=1&filter=carID,eq," . $car), true);
}

if($edit){
echo '<h1>Edit Car</h1>';
echo '<form action="?edit=' . $car . '" method="POST">';
}elseif($new){
	echo '<h1>New Car</h1>';
	echo '<form action="?add=1" method="POST">';
}

$brands = json_decode(getCall($config->api_url . "carbrands?transform=1"), true);
$models = json_decode(getCall($config->api_url . "carmodels?transform=1"), true);
$colors = json_decode(getCall($config->api_url . "colors?transform=1"), true);


echo '<pre>'; print_r($cardata); echo '</pre>---------------------------------<br>';
echo '<pre>'; print_r($brands); echo '</pre>---------------------------------<br>';
?>
<div class="form-group">
  
  <label for="brand">Brand</label><i class="fa fa-plus-circle righticon" aria-hidden="true"></i>
  <select class="form-control" name="brand">
  <?php
  if($new){
	foreach($brands['carbrands'] as $brand){
		echo '<option value="' . $brand['brandID'] . '">' . $brand['brand'] . '</option>';
	}
} elseif($edit){
	foreach($cardata['carUsers'] as $car){
	foreach($brands['carbrands'] as $brand){
	if($brand["brand"] == $cardata["brand"]){
		$brandID =  $brand['brandID'];
	}
}
echo '<option value="' . $brandID .'">' . $brand["brand"] .'</option>';
foreach($brands["carbrands"] as $brand){
	if($brand["brand"] != $cardata["brand"]){
		echo '<option value="' . $brand["brandID"] . '">' . $brand["brand"] . '</station>';
	}
}
}
}
  ?>
  </select>
  </div>
  <div class="form-group">
  
  <label for="model">Model</label><i class="fa fa-plus-circle righticon" aria-hidden="true"></i>
  <select class="form-control" name="model">
  <?php
	foreach($models['carmodels'] as $model){
		echo '<option value="' . $model['modelID'] . '">' . $model['model'] . '</option>';
	}
  ?>
  </select>
  </div>
  <div class="form-group">
  
  <label for="color">color</label><i class="fa fa-plus-circle righticon" aria-hidden="true"></i>
  <select class="form-control" name="color">
  <?php
	foreach($colors['colors'] as $color){
		echo '<option value="' . $color['colorID'] . '">' . $color['color'] . '</option>';
	}
  ?>
  </select>
  </div>


  <div class="form-group">
  <label for="licence">Licence</label>
    <input type="text" class="form-control" name="licence" id="licence" placeholder="AG272727">
  </div>
  <div class="form-group">
  <label for="seats">Seats</label>
  <input type="number" name="seats" min="1" max="10" value="5" class="form-control" id="seats">
  </div>
 

  <button type="submit" class="btn btn-success">Submit</button>

</form>

<?php

} else {
	echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> You need to login first
  </div>
';
}
?>
			</div>
			</main>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
				</body>
			</html>