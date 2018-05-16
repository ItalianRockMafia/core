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
				<a class="nav-link" href="settings.php">Settings <span class="sr-only">(current)</span></a>
			  </li>
				<li class="nav-item">
        	<a class="nav-link" href="<?php echo $config->app_url; ?>meetup">Events</a>
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

require 'global/functions/apicalls.php';
require 'global/functions/telegram.php';
$config = require "config.php";


$tg_user = getTelegramUserData();

//check if user is logged in
if ($tg_user !== false) {

	//add a new car
	if(isset($_GET['add'])){
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$color = $_POST['color'];
		$licence = $_POST['licence'];
		$seats = $_POST['seats'];
		$owner = $_SESSION['irmID'];
		$postfields = "{\n\t\"brandIDFK\": \"$brand\", \n\t\"modelIDFK\": \"$model\",\n\t\"colorIDFK\": \"$color\",\n\t\"licence\": \"$licence\",\n\t\"places\": \"$seats\",\n\t\"ownerIDFK\": \"$owner\"\n\t\n}";
		$car = postcall($config->api_url . "cars", $postfields);
		if(is_numeric($car)){
			header('Location: settings.php');
		}
	}

	if(isset($_GET['update'])){
		//update car
		$car = $_GET['update'];
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$color = $_POST['color'];
		$licence = $_POST['licence'];
		$seats = $_POST['seats'];
		$owner = $_SESSION['irmID'];
		$postfields = "{\n\t\"brandIDFK\": \"$brand\", \n\t\"modelIDFK\": \"$model\",\n\t\"colorIDFK\": \"$color\",\n\t\"licence\": \"$licence\",\n\t\"places\": \"$seats\",\n\t\"ownerIDFK\": \"$owner\"\n\t\n}";
		$status = putCall($config->api_url . "cars/" . $car, $postfields);
		if(is_numeric($status)){
			header('Location: settings.php');
		}
	}
	

if(isset($_GET['delete'])){
	//delete a car
	deleteCall($config->api_url . "cars/" . $_GET['delete']);
	header('Location: settings.php');
}

//check if show form to add or edit a car
if(isset($_GET['new'])){
	$new = true;
} elseif(isset($_GET['edit'])){
	$edit = true;
	$car = $_GET['edit'];
	$cardata = json_decode(getCall($config->api_url . "carUsers?transform=1&filter=carID,eq," . $car), true);
}

//init forms for new and edit car
if($edit){
echo '<h1>Edit Car</h1>';
echo '<form action="?update=' . $car . '" method="POST">';
}elseif($new){
	echo '<h1>New Car</h1>';
	echo '<form action="?add=1" method="POST">';
}

//get available car attribztes 
$brands = json_decode(getCall($config->api_url . "carbrands?transform=1"), true);
$models = json_decode(getCall($config->api_url . "carmodels?transform=1"), true);
$colors = json_decode(getCall($config->api_url . "colors?transform=1"), true);



?>
<!-- new car / edit car form -->
<div class="form-group">
  
  <label for="brand">Brand</label><a href="dataedit.php?brand=1"><i class="fa fa-plus-circle righticon" aria-hidden="true"></i></a>
  
  <?php
  if($new){
		echo '<select class="form-control" name="brand">';
	foreach($brands['carbrands'] as $brand){
		echo '<option value="' . $brand['brandID'] . '">' . $brand['brand'] . '</option>';
	}
} elseif($edit){
echo '<select class="form-control" name="brand" disabled>';
	foreach($cardata['carUsers'] as $userCar){
		foreach($brands["carbrands"] as $brand){
			if($brand["brand"] == $userCar["brand"]){
				$brandID =  $brand['brandID'];
			}
		}
		?>
				<option value="<?php echo $brandID;?>"><?php echo $userCar["brand"]; ?></option>
				<?php
					foreach($brands["carbrands"] as $brand){
						if($brand["brand"] != $userCar["brand"]){
							echo '<option value="' . $brand["brandID"] . '">' . $brand["brand"] . '</option>';
						}
					}
				}}
				?>
			</select><?php

  ?>
  </div>

  <div class="form-group">
  
  <label for="model">Model</label><a href="dataedit.php?model=1"><i class="fa fa-plus-circle righticon" aria-hidden="true"></i></a>
  <?php
  if($new){
		echo '<select class="form-control" name="model">';
	foreach($models['carmodels'] as $model){
		echo '<option value="' . $model['modelID'] . '">' . $model['model'] . '</option>';
	}
} elseif($edit){
	echo '<select class="form-control" name="brand" disabled>';
	foreach($cardata['carUsers'] as $userCar){
		foreach($brands["carModels"] as $model){
			if($model["model"] == $userCar["model"]){
				$modelID =  $model['modelID'];
			}
		}
		?>
				<option value="<?php echo $modelID;?>"><?php echo $userCar["model"]; ?></option>
				<?php
					foreach($models["carModels"] as $model){
						if($model["model"] != $userCar["model"]){
							echo '<option value="' . $model["modelID"] . '">' . $model["model"] . '</option>';
						}
					}
				}}
				?>
			</select><?php

  ?>
  </div>
  
	
	<div class="form-group">
  
  <label for="color">Color</label><a href="dataedit.php?color=1"><i class="fa fa-plus-circle righticon" aria-hidden="true"></i></a>
  <select class="form-control" name="color">
  <?php
  if($new){
	foreach($colors['colors'] as $color){
		echo '<option value="' . $color['colorID'] . '">' . $color['color'] . '</option>';
	}
} elseif($edit){

	foreach($cardata['carUsers'] as $userCar){
		foreach($colors["colors"] as $color){
			if($color["color"] == $userCar["color"]){
				$colorID =  $color['colorID'];
			}
		}
		?>
				<option value="<?php echo $colorID;?>"><?php echo $userCar["color"]; ?></option>
				<?php
					foreach($colors["colors"] as $color){
						if($color["color"] != $userCar["color"]){
							echo '<option value="' . $color["colorID"] . '">' . $color["color"] . '</option>';
						}
					}}}
				?>
			</select><?php

  ?>
  </div>

  <div class="form-group">
  <label for="licence">Licence</label>

	<?php if($new){
		echo '<input type="text" class="form-control" name="licence" id="licence" placeholder="AG272727">';
	}elseif($edit){
		echo '<input type="text" class="form-control" name="licence" id="licence" value="'. $cardata['carUsers'][0]['licence'] . '">';
	}
	?>
  </div>
  <div class="form-group">
  <label for="seats">Seats</label>
	<?php if($new){
		echo '<input type="number" name="seats" min="1" max="10" value="5" class="form-control" id="seats">';
	}elseif($edit){
		echo '<input type="number" name="seats" min="1" max="10" value="' . $cardata['carUsers'][0]['places'] . '" class="form-control" id="seats">';
	}
	?>
  
  </div>
 

  <button type="submit" class="btn btn-success">Submit</button>

</form>
<!-- end of form -->
<?php

} else {
	// user is not logged in 
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
