<?php
function add_message_bd($data){

// Добавление записи в БД
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/create.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array(
      'chat_id'     => $data['chat_id'],
      'user_id'     => $data['user_id'],
      'last_message'   => $data['last_message']
    ))
));
$response = curl_exec($ch);
curl_close($ch);

return $response;
}

function is_exists_message_bd($data){
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/is_exists.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array(
      'chat_id'     => $data['chat_id'],
      'user_id'     => $data['user_id']
    ))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function update_message_bd($data){
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/update.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array(
      'chat_id'     => $data['chat_id'],
      'user_id'     => $data['user_id']
    ))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function read_one_message_bd($data){
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/read_one.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array(
      'chat_id'     => $data['chat_id'],
      'user_id'     => $data['user_id']
    ))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function delete_message_bd($data){
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://test.newsparser.ru/code/api/bot/delete.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(array(
      'chat_id'     => $data['chat_id'],
      'user_id'     => $data['user_id']
    ))
  ));
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

