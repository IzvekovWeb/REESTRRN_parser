<?php 


// include('../../../vendor/autoload.php'); //Подключаем библиотеку
//https://api.telegram.org/bot1364265656:AAFsxPuqB-jbsnftB0A8uajtWtC6fXkzSt8/setWebhook?url=https://test.newsparser.ru/code/libs/telegram/TelegramMessageHandler.php

use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;


class Telegram {

  public static function send_message($messages, $chat_id){

    $bot = new Api('1364265656:AAFsxPuqB-jbsnftB0A8uajtWtC6fXkzSt8'); //Устанавливаем токен, полученный у BotFather
    // $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя
    $keyboard = new Keyboard();
  
    $inline_keybaord = $keyboard->make()->inline()
      ->row(
        $keyboard->inlineButton(['text'=>'Полезная', 'callback_data' => '/curNewsIsUseful']),
        $keyboard->inlineButton(['text'=>'Не пригодилась', 'callback_data' => '/curNewsIsUnseful'])
      );
  
    foreach ($messages as $text){
      

      // Разделяем сообщение, если оно длинее 4096 символов 
      $messages_arr = null;
      if (strlen($text) % 4096 > 0) {  
        $messages_arr = str_split($text, 4096);
      }
      
      // Отправка сообщения\ий
      if($messages_arr == null){
        $bot->sendMessage([
          'chat_id' => $chat_id,
          'text' => $text,
          'reply_markup' => $inline_keybaord,
          'parse_mode' => 'HTML',
          'disable_web_page_preview' => true,
        ]);
      }else {
        for($i = 0; $i < count($messages_arr ); $i++){ 

          // Добавляем клавиатуру, только на последнем сообщении
          if(count($messages_arr )-1 == $i) 
            $reply_markup = $inline_keybaord; 
          else
            $reply_markup = $keyboard->make()->inline()->row();


          $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $messages_arr[$i],
            'reply_markup' => $reply_markup,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
          ]);
        }
      }
      
    }

  }
 
 
 

  /* 
  * Формирует сообщение для отправки пользователю
  *
  * Вход: массив необработаннызх новостей
  * Выход: массив сообщений, готовых к отправке
  */
  public static function create_message($mas)
  {   
      $messages_arr = [];
      foreach ($mas as $el) {
        $message = '';
        $message .= "<b>Заголовок:</b> " . $el['title'] . PHP_EOL . PHP_EOL;
        $message .= "<b>Описание:</b> "  . $el['desc'] . PHP_EOL . PHP_EOL;
        $message .= "<b>Новость:</b> <a href='"  . $el['link'] . "'>ссылка</a>" . PHP_EOL . PHP_EOL;
        $message .= "<b>Сайт:</b> <a href='"  . $el['site_url'] . "'>" . $el['site_name'] ."</a>" . PHP_EOL . PHP_EOL;
        $message .= "<b>Ключевые слова:</b> ";
        foreach ($el['keywords'] as $key){
            $message .= $key . " ";
        }
        $message .= PHP_EOL . PHP_EOL;
        if ($el['time'] != ''){
          $message .= "<b>Время:</b> " . $el['time'] . PHP_EOL . PHP_EOL;
        }else{
          $message .= "<b>Время отправки парсером:</b> " . date("Y-m-d H:i:s") . PHP_EOL . PHP_EOL;
        }
        $message .= '============================' . PHP_EOL . PHP_EOL;

        $messages_arr[] .= $message;
      } 
      return $messages_arr;
  }



} 




?>