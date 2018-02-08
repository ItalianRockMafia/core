<?php
function getTelegramUserData() {
	if (isset($_COOKIE['tg_user'])) {
		$auth_data_json = urldecode($_COOKIE['tg_user']);
		 $auth_data = json_decode($auth_data_json, true);
		return $auth_data;
	}
	return false;
}