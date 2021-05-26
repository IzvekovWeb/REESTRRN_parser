<?php
function add_message_bd($data){
 
  $ch = curl_init();
  $data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/create.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  ));
$response = curl_exec($ch);
curl_close($ch);

return $response;
}

function is_exists_message_bd($data){
  $ch = curl_init();
  $data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/is_exists.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function update_message_bd($data){
  $ch = curl_init();
  $data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/update.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function read_one_message_bd($data){
  $ch = curl_init();
  $ch = curl_init();
  $data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/read_one.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function delete_message_bd($data){
  $ch = curl_init();
  $data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/delete.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function login_user_TG($user){
  $ch = curl_init();
  $data_string = json_encode ($user, JSON_UNESCAPED_UNICODE);
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/user/login.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data_string,
    CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

