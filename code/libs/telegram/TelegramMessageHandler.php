<?php

include('../../../vendor/autoload.php'); //Подключаем библиотеку
 
use Telegram\Bot;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Methods\Query;

$telegram = new Api('1364265656:AAFsxPuqB-jbsnftB0A8uajtWtC6fXkzSt8'); //Устанавливаем токен, полученный у BotFather
$result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя


// $telegram->removeWebhook();
// $telegram->setWebhook("https://test.newsparser.ru/code/libs/telegram/TelegramMessageHandler.php");
// $telegram-> getWebhookinfo();



$command = $result["message"]["text"]; //Текст сообщения
$chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
$username= $result["message"]["from"]["username"]; //Уникальный идентификатор пользователя
// $name    = $result["message"]["from"]["first_name"]; //Уникальный идентификатор пользователя

$keyboard = new Keyboard();
 
$reply_markup = $keyboard->make()
      ->row($keyboard->button(['text'=>'Войти']))
      ->row($keyboard->button(['text'=>'Регистрация']))
      ->row($keyboard->button(['text'=>'Информация']));
 
switch ($command) {
  case '/start': 

    $text = "Здравствуйте, ". $username ."! Вас приветствует бот СМАНИ.". PHP_EOL . PHP_EOL .
    "Чтобы воспользоваться ботом войдите в систему. Если у вас нет аккаунта, вы можете зарегистрироваться прямо тут, нажав кнопку 'Зарегистрироваться'";

    $telegram->sendMessage(
      [ 
        'chat_id' => $chat_id, 
        'text' => $text, 
        'reply_markup' => $reply_markup,
        'parse_mode' => 'HTML',
        'one_time_keyboard' => true,
        'resize_keyboard' => true
      ]
    );
    break;
  case 'Войти' || '/enter': 
  
    $text = "Ваш логин: " . $username. PHP_EOL . PHP_EOL .
    "Введите пароль: ";

    $telegram->sendMessage(
      [
        'chat_id' => $chat_id, 
        'text' => $text, 
        'reply_markup' => $keyboard->remove([
          'hide_keyboard'=>true
        ]),
        'selective' => null,
        'parse_mode' => 'HTML'
      ]
    );
    break; 
  case 'Регистрация' || '/register': 

    $text = "Зарегистироваться вы можете у нас най сайте <a href='https://test.newsparser.ru/'>newsparser.ru</a>";
    $telegram->sendMessage(
      [ 
        'chat_id' => $chat_id, 
        'text' => $text, 
        'reply_markup' => $reply_markup,
        'parse_mode' => 'HTML'
      ]
    );
    
    break; 
  case 'Информация' || '/info':  
    $text = "Данный бот работает в тестовом режиме, поэтому все услуги предоставляются бесплатно. В дальнейшем будет введене система подписок, разделяющая поступающие новости на разные группы.". PHP_EOL . PHP_EOL .
    "Зарегистрироваться или управлять своим аккаунтом вы можеет на сайте <a href='https://test.newsparser.ru/'>newsparser.ru</a>";

    $telegram->sendMessage(
      [ 
        'chat_id' => $chat_id, 
        'text' => $text, 
        'reply_markup' => $reply_markup,
        'parse_mode' => 'HTML',
        'one_time_keyboard' => true,
        'resize_keyboard' => true
      ]
    );
    break;
} 
 
?>

<!-- 
Array (
	[update_id] => 17584194
	[message] => Array (
		[message_id] => 26
		[from] => Array (
			[id] => 123456789
				[is_bot] => 
				[first_name] => UserName
				[language_code] => ru-US
			)
		[chat] => Array (
			[id] => 123456789
			[first_name] => UserName
			[type] => private
		)
		[date] => 1541888068
		[text] => Привет бот!
	)
) -->
