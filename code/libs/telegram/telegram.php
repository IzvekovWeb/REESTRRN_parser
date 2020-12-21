<?php 



class Telegram {

  // сюда нужно вписать токен вашего бота
  const TELEGRAM_TOKEN = '1364265656:AAH7fgfnZE4n3bsaeEFC0PVJoStnYnWVt8M';

  // сюда нужно вписать ваш внутренний айдишник
  // const TELEGRAM_CHATID_COMPANIES = -465108518; //группа для компаний
  // const TELEGRAM_CHATID_WORDS = -478273397; //группа для слов
  // const TELEGRAM_CHATID = 445743340; // я
 

  public static function send_message($text, $chat_id)
  {
      $ch = curl_init();
      curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . self::TELEGRAM_TOKEN . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'chat_id' => $chat_id,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => true,
                )),
            )
        );
        curl_exec($ch);
        curl_close($ch);
  }

  public static function create_message($mas)
  {   $message = '';
      foreach ($mas as $el) {
         

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
      }
      return $message;
  }

} 
?>