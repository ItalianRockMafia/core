<?php
session_start();

$config = require_once('config.php');

if(isset($_GET['r'])){
  $redirect_url = $_GET['r'];
  setcookie('referer', $redirect_url);
  unset($_GET['r']);
}

function checkTelegramAuthorization($auth_data) {
  global $config;
  $check_hash = $auth_data['hash'];
  unset($auth_data['hash']);
  $data_check_arr = [];
  foreach ($auth_data as $key => $value) {
   // $data_check_arr[] = $key . '=' . $value;
    $data_check_arr[] = $key . '=' . str_replace('https:/t', 'https://t', $value);
  }
  sort($data_check_arr);
  $data_check_string = implode("\n", $data_check_arr);
  $secret_key = hash('sha256', $config->telegram['token'], true);
  $hash = hash_hmac('sha256', $data_check_string, $secret_key);
  if (strcmp($hash, $check_hash) !== 0) {
    throw new Exception('Data is NOT from Telegram');
  }
  if ((time() - $auth_data['auth_date']) > 86400) {
    throw new Exception('Data is outdated');
  }
  return $auth_data;
}

function saveTelegramUserData($auth_data) {
  $auth_data_json = json_encode($auth_data);
  setcookie('tg_user', $auth_data_json);
}


try {
  $auth_data = checkTelegramAuthorization($_GET);
  saveTelegramUserData($auth_data);
} catch (Exception $e) {
  die ($e->getMessage());
}

  header('Location: login.php');

?>