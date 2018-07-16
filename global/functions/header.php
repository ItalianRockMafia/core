<?php
function renderMenu(){
	global $config;
	$data = $config->menu;
	$result = array();
	foreach($data as $title => $url){
		$result[] = array('title' => $title, 'link' => $url, 'active' => false );
	}
	return $result;
}

function getHeader($options){
	global $config;

$header = '
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
 	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="' . $config->app_url . 'global/main.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<title>'. $options['title'] .'</title>
	'.
		$options['custom_header']
	.'

	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
	<a class="navbar-brand" href="'. $config->app_url . '">'. $config->app_title .'</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		';
		$location = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		foreach($options['nav'] as $entry){
			if($location == $entry['link']){
				$entry['active'] = true;
			}
			if($entry['active']){
				$header .= '<li class="nav-item active">';
			} else{
				$header .= '<li class="nav-item">';
			}
			$header .= '<a class="nav-link" href="' . $entry['link'] . '">' . $entry['title'];
			if($entry['active']){
				$header .= '<span class="sr-only">(current)</span>';
			
			}
			$header .= '</a></li>';

		}
		$header .= '</ul>';
		$header .= '
				<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
        			<a class="nav-link" href="' . $config->app_url . 'login.php?logout=1">Logout</a>
      			</li>
		</ul>
	</div>
</nav>';


return $header;
}