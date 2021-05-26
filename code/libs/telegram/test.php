<?php 

include('../../../vendor/autoload.php'); //Подключаем библиотеку
include('../../functions/bot_func.php');
 
 

$data = [
  'chat_id' => 445743340,
  'user_id' => 445743340,
  'last_message' => '/enter'
]; 
 

if (json_decode (is_exists_message_bd($data))){ 
  // Получаем последние данные
  $last = json_decode(read_one_message_bd($data));
  if($last -> last_message == '/enter'){
    $user = [
      'loginx' => 'Izvekov_Alex',
      'passwordx' => 'admin'
    ];
    // Отправляем логин и пароль на проверку
    $result = json_decode(login_user_TG($user));

    echo "<pre>";
    var_dump($result);
    echo "</pre>";

    $text = "";
    if(!empty($result)) {
      $text = $result->message . PHP_EOL. PHP_EOL;
      if(!empty($result->user)){

        $text .= "Ваш ID: " . $result->user->id . PHP_EOL;
        $text .= "Логин: " . $result->user->loginx . PHP_EOL;
        $text .= "Имя: " . $result->user->first_name . PHP_EOL;
        $text .= "Фамилия: " . $result->user->second_name . PHP_EOL;
        $status = "";
        if($result->user->status == 'admin'){$status = "Администратор";}
        else {$status = "Клиент";}
        $text .= "Статус: " . $status . PHP_EOL. PHP_EOL;
        $text .= "-----------------------" . PHP_EOL. PHP_EOL;
        $text .= "Бот автоматически начнёт работу через 5 секунд" . PHP_EOL;
      }
    } 
    

    $telegram->sendMessage(
      [
        'chat_id' => $chat_id, 
        'text' => $text,
        'parse_mode' => 'HTML'
      ]
    );
  }
}

?>