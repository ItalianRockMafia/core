<?php
session_start();
require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
$config = require "config.php";


$tg_user = getTelegramUserData();

if(isset($_GET['emp'])){
	$status = $_POST['empbsc'];
	if(!isset($status)){
		$status = "0";
	}
	$postfields = "{\n \"bsc\": \"$status\" \n}";
	putCall($config->api_url . "users/" . $_SESSION['irmID'], $postfields);
	header('Location: settings.php');
	
	
	
}
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
        	<a class="nav-link" href="<?php echo $config->app_url;?>meetup">Events</a>
      	</li>
				<li class="nav-item">
        				<a class="nav-link" href="<?php echo $config->app_url; ?>emp">EMP</a>
      				</li>
							<li class="nav-item">
        				<a class="nav-link" href="<?php echo $config->app_url; ?>vinyl">Vinyls</a>
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



if ($tg_user !== false) {
	$tgID = $tg_user["id"];
	$firstname = $tg_user["first_name"];
	$lastname = $tg_user["last_name"];
	$username = $tg_user["username"];

	$_SESSION['tgID'] = $tg_user["id"];
	$_SESSION['firstname'] = $tg_user["first_name"];
	$_SESSION['lastname'] = $tg_user["last_name"];
	$_SESSION['username'] = $tg_user["username"];

	$userStations = json_decode(getCall($config->api_url . "userStation?transform=1&filter=telegramID,eq," . $tg_user["id"]),true);
	$stations =  json_decode(getCall($config->api_url . "stations?transform=1"), true);
	$mycars = json_decode(getCall($config->api_url . "carUsers?transform=1&filter=telegramID,eq," . $tg_user["id"]), true);


	if(empty($userStations["userStation"])){
		echo '<div class="alert alert-danger" role="alert">
		You need to register your self in the IRM-Database. Please contact an admin.
	  </div>';


	} else {
	echo '<h1>Hi, ' . $firstname . '!</h1>';
	echo '<h2>Your username is: <a href="https://t.me/' . $username . '" target="_blank">@' . $username . '</a>.</h2>';

	foreach($userStations["userStation"] as $userStation){
		$_SESSION['irmID'] = $userStation['userID'];
		$myacc = json_decode(getCall($config->api_url . "users/" .$_SESSION['irmID'] . "?transform=1"), true);
		
?>
<div class="topspacer"></div>
<h3>EMP</h3>
<form method="POST" action="settings.php?emp=1" class="form-inline">
<div class="form-check mb-2 mr-sm-2">
<input type="checkbox" name="empbsc" value="1" class="form-check-input" id="empbsc" <?php if($myacc['bsc'] == "1"){echo "checked";}?>>
<label class="form-check-label" for="inlineFormCheck">
      I'm a EMP-Backstage Club member
    </label>
  </div>
	<button type="submit" class="btn btn-success mb-2">Submit</button>

	</form>
	<div class="topspacer"></div>

<h3>Select your station</h3>
<form method="POST" action="stationmgmt.php?upatestation=1" class="form-inline">
	<div class="form-group mb-2">
  	<label for="userID" class="sr-only">User ID</label>
    <input type="text" readonly class="form-control-plaintext" id="userID" value="<?php echo $tgID . ' // ' . $username; ?>">
  </div>
  <div class="form-group mx-sm-3 mb-2">
  	<label for="station" class="sr-only">Station</label>
		<select class="form-control" name="station"><?php
		foreach($stations["stations"] as $station){
		if($station["station"] == $userStation["station"]){
			$userStationID =  $station['stationID'];
		}
	}
	?>
  		<option value="<?php echo $userStationID;?>"><?php echo $userStation["station"]; ?></option>
			<?php
				foreach($stations["stations"] as $station){
					if($station["station"] != $userStation["station"]){
						echo '<option value="' . $station["stationID"] . '">' . $station["station"] . '</station>';
					}
				}
			?>
		</select>
	</div>
	<div class="form-check mb-2 mr-sm-2">
  	<input type="checkbox" name="publictransport" value="1" class="form-check-input" id="publictransport" <?php if($userStation['public_transport'] == "1"){echo "checked";}?>>
    <label class="form-check-label" for="publictransport">I'm using public transport </label>
	</div>
  <button type="submit" class="btn btn-success mb-2">Confirm Station</button>
</form>

<div class="topspacer"></div>
<h3>Or provide a new one</h3>
<form method="POST" action="stationmgmt.php?addstation=1" class="">
<div class="form-group">
    
    <input type="text" class="form-control" name="newStation" aria-describedby="stationHelp" placeholder="Station Name">
    <small id="stationHelp" class="form-text text-muted">Please provide the name, as it is in the SBB mobile app.</small>
  </div>
	<button type="submit" class="btn btn-success mb-2">Add Station</button>
	</form>

<?php
	}
?>
<div class="topspacer"></div>
<h3>Your cars <a href="car.php?new=1"><i class="fa fa-plus-circle righticon" aria-hidden="true"></i></a></h3>
<div class="table-responsive">
<table class="table">
<thead>
	<tr>
		<th scope="col">Brand</th> 
		<th scope="col">Model</th> 
		<th scope="col">Color</th> 
		<th scope="col">Licence<htd>
		<th scope="col">Seats</th>
		<th scope="col">Options</th>
</thead>
<tbody>

<?php
if(!empty($mycars['carUsers'])){
foreach($mycars['carUsers'] as $car){
	echo '<tr><td>' . $car["brand"] . '</td><td>' . $car["model"] . '</td><td>' . $car["color"] . '</td><td>' . $car["licence"] . '</td><td>' . $car["places"] . '</td><td><a href="car.php?edit=' . $car['carID'] . '" class="btn btn-success">Edit</button><a href="car.php?delete=' . $car['carID'] . '" class="btn btn-danger">Delete</button></td></tr>';
}}
?>
</tbody>
</table>
<?php
if(empty($mycars['carUsers'])){
	echo '<div class="alert alert-warning" role="alert">
  You have no cars. register a <a href="car.php?new=1">new one</a>
</div>';
}
?>
</div>
<?php
}
} else {
	echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> You need to <a href="login.php">login</a> first
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