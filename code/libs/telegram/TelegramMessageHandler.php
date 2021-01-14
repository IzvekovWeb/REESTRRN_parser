<?php

include('../../../vendor/autoload.php'); //Подключаем библиотеку
 
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Methods\Query;

$telegram = new Api('1364265656:AAH7fgfnZE4n3bsaeEFC0PVJoStnYnWVt8M'); //Устанавливаем токен, полученный у BotFather
$result = $telegram -> getWebhookUpdate(); //Передаем в переменную $result полную информацию о сообщении пользователя

// $telegram->removeWebhook();
// $telegram->setWebhook("https://test.newsparser.ru/code/libs/telegram/TelegramMessageHandler.php");

// $chat_id = $result['message']['chat']['id'];
// $text = $result['message']['text'];
// $callback_query = $result['callback_query'];
  
echo "<pre>";
var_dump($result['callback_query']); 
echo "</pre>";

// $query = new Query();

// $query->answerCallbackQuery([
//   'callback_query_id'  => '',
//   'text'               => 'Что-то произошло',
//   'show_alert'         => true,
// ]);


// $keyboard = new Keyboard();
  
// $inline_keybaord = $keyboard->make()->inline()
//   ->row(
//     $keyboard->inlineButton(['text'=>'Полезная', 'callback_data' => '1']),
//     $keyboard->inlineButton(['text'=>'Не пригодилась', 'callback_data' => '2'])
//   );

// $telegram->sendMessage([
//   'chat_id' => $chat_id,
//   'text' => $text,
//   'reply_markup' => $inline_keybaord,
//   'parse_mode' => 'HTML',
//   'disable_web_page_preview' => true,
// ]); 

switch ($text) {
  case '/curNewsIsUseful': 

    $callback = $result->getCallbackQuery();
    echo $callback;
    // $message  = $callback->getMessage();
    // $chatId   = $message->getChat()->getId();
    // $data     = $callback->getData();

    // var_dump($callback);
    
    $text = "callback";

      $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => $text
      ]);

    break;

  case '/curNewsIsUnseful': 
  
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chatId = $update["message"]["chat"]["id"]; 
    $text = $chatId;

    $telegram->sendMessage([
      'chat_id' => $chat_id,
      'text' => "Записали в БД что новость ПЛОХАЯ", 
    ]);
  
    
    break;
 
  case 'remove':  
    $inline_keybaord = $keyboard->remove();


    $telegram->sendMessage([
      'chat_id' => $chat_id,
      'text' => $text,
      'reply_markup' => $inline_keybaord
    ]);
    break;
} 
 
?>