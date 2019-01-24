<?php
session_start();
require_once 'global/functions/apicalls.php';
require_once 'global/functions/telegram.php';
require_once 'global/functions/header.php';
require_once 'global/functions/footer.php';
require_once 'global/functions/irm.php';


$config = require_once "config.php";


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

$menu = renderMenu();
$options['nav'] = $menu;
$options['title'] = "IRM | Settings";
$header = getHeader($options);
$footer = renderFooter();
echo $header;
?>

<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php



if ($tg_user !== false) {
	$tgID = $tg_user["id"];
	$firstname = $tg_user["first_name"];
	$lastname = $tg_user["last_name"];
	$username = $tg_user["username"];

	saveSessionArray($tg_user);
	$access = $_SESSION['access'];
	if($access > 2){
		$a = true;
	} else {
		$a = false;
	}

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
		
		if($a){
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
		<?php } ?>

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

echo $footer;
?>
