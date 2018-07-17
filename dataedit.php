<?php
session_start();
require_once 'global/functions/header.php';
require_once 'global/functions/footer.php';
require_once 'global/functions/apicalls.php';
require_once 'global/functions/telegram.php';
require_once 'global/functions/irm.php';

$config = require_once "config.php";

$menu = renderMenu();
$options['nav'] = $menu;
$options['title'] = "IRM | Modify data";
$header = getHeader($options);
$footer = renderFooter();
echo $header;

?>

<div class="topspacer"></div>
<main role="main">
	<div class="container">

<?php


$tg_user = getTelegramUserData();
saveSessionArray($tg_user);
if($_SESSION['access'] >= 3){



//check if user is logged in
if ($tg_user !== false) {
	//get attribute to add and add it
	if(isset($_GET['addbrand'])){
		$brand = $_POST['brand'];
		$postfields = "{\"brand\": \"$brand\"}";
		postcall($config->api_url . "carbrands", $postfields);
		header('Location: car.php?new=1');
	}

	if(isset($_GET['addmodel'])){
		$model = $_POST['model'];
		$postfields = "{\"model\": \"$model\"}";
		postcall($config->api_url . "carmodels", $postfields);
		header('Location: car.php?new=1');
	}

	if(isset($_GET['addcolor'])){
		$color = $_POST['color'];
		$postfields = "{\"color\": \"$color\"}";
		postcall($config->api_url . "colors", $postfields);
		header('Location: car.php?new=1');
	}


	//get attribute user wants to add and display correspodenting form
if(isset($_GET['brand'])){
	?>
<form method="POST" action="?addbrand=1">
<div class="form-group">
    <label for="brand">New Brand</label>
    <input type="text" class="form-control" id="brand" name="brand" placeholder="VW">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  </form>
<?php
}

if(isset($_GET['model'])){
	?>
<form method="POST" action="?addmodel=1">
<div class="form-group">
    <label for="model">New Model</label>
    <input type="text" class="form-control" name="model" id="model" placeholder="Polo">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  </form>
<?php
}

if(isset($_GET['color'])){
	?>
<form method="POST" action="?addcolor=1">
<div class="form-group">
    <label for="color">New Color</label>
    <input type="text" class="form-control" id="color" name="color" placeholder="Pink">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  </form>
<?php
}

} else {
	echo '
	<div class="alert alert-warning" role="alert">
	<strong>Warning.</strong> Guest access is disabled
  </div>
';
}
} else {
	//user is not logged in
	echo '
	<div class="alert alert-danger" role="alert">
	<strong>Error.</strong> You need to <a href="login.php>login</a> first
  </div>
';
}
echo $footer;
?>
			