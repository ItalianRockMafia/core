<?php
return (object) array(
	'api_url' => "ENTER_API_URL_HERE", //with ending slash
	'app_url' => "ENTER_APP_URL_HERE", //with ending slash
	'telegram' => array(
		'chatID' => "CHAT_ID_HERE",
		'bot' => "BOT_USERNAME_HERE",
		'token' => "BOT_TOKEN_HERE"
	),
	'google' => array(
		'map_api_key' => "ENTER_G_MAPS_API_KEY_HERE"
	),
	'spotify' => array(
		'client_id' => "ENTER_SPOTIFY_CLIENT_ID_HERE",
		'client_secret' => "ENTER_SPOTIFY_CLIENT_SECRET_HERE"
	),
	'lastfm' => array(
		'api_key' => "LAST_FM_API_KEY_HERE",
		'api_root' => "http://ws.audioscrobbler.com/"
	)
);