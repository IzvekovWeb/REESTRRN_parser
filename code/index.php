<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

require('functions/news_func.php');
require('mail.php');
require('functions/function.php');
require('libs/phpQuery/phpQuery.php');
// include('../vendor/autoload.php'); //Подключаем библиотеку
require('libs/telegram/TelegramBot.php');
require('parsers/SiteParser.php');
require('api/config/database.php');
 
// file_put_contents('log.txt', 'Программа запущена ' . date('Y-m-d H:i:s') . '<br>', FILE_APPEND);

$t_bot = new Telegram();
$new_news = Array();
 

// for ($i = 0; $i < 6; $i++) {
  $start_time =  microtime(true);

  $result = start(); 
 
  // dump($result);
  if (!$result['error']){ 

    if (count($result['result']) > 0) {
        
      // Проходимяся по сайтам
      foreach ($result['result'] as $site => $cur_site_news){ 

        echo $site . '<br>';

        if(count($cur_site_news) > 0) {
          // Проходимся по новостям на конкретном сайте
          foreach ($cur_site_news as  $one_news){ 

            // Проверяем есть ли такая новость в БД
            // Ответ преобразуем в boolean
            $is_news_exist = filter_var(is_news_exist_bd($one_news), FILTER_VALIDATE_BOOLEAN, ['flags'=>FILTER_NULL_ON_FAILURE]);
            // $is_news_exist = is_news_exist_bd($one_news); // string

            // Отсеиваем уже добавленный\отправленные новости
            if ($is_news_exist == "true") {

              echo "<br>" . "Такая новость уже есть - ".$one_news['title'] ."<br>";

            }else{
              echo "<br>" . "Такой новости нет - ".$one_news['title'] ."<br>"; 

              if ($one_news != null) {
                // Добавляем новость в бд
                add_news_bd($one_news);

                array_push($new_news, $one_news); 
              }
            } 

          } //foreach
        } //if
      } //foreach
 

      // Отправляем новые новости
      if(!empty($new_news)){
        // переводим новости
        // $new_news_companies = translate_news($new_news_companies);
        

        // Отправка в телеграм
        // $t_bot->send_message($t_bot->create_message($new_news_companies), -434052006);
        
        // Отправка на почту 
        $messages = $t_bot->create_message_HTML($new_news);
        send_mail($messages);

        $new_news = [];
      } 
      
    }
    else  {
      echo "В данный момент нет подходящих новостей" . PHP_EOL;
      // dump($result);
    }
  }
  else{
    echo $result['message'] . PHP_EOL;
  } 
  echo "<br> Парсинг занял: " . round(microtime(true) - $start_time, 4) . " сек.<br>";
//   sleep(10);
// }
 
// file_put_contents('log.txt', 'Программа зевершена ' . date('"Y-m-d H:i:s"') . '<br><br>', FILE_APPEND);



function start($words=[], $companies=[]){

  // Стартовые данные 
  // Позже будут в БД
  $urls = [
    // 'aoreestr.ru'     => ['url' => 'https://aoreestr.ru/press','type' => 'html', 'curl' => false],
    // 'vrk.ru'          => ['url' => 'https://www.vrk.ru/news','type' => 'html', 'curl' => false],
    // 'mrz.ru'          => ['url' => 'http://mrz.ru/company/news/','type' => 'html', 'curl' => false],
    // 'rrost.ru'        => ['url' => 'https://rrost.ru/ru/press/events/','type' => 'html', 'curl' => false],
    // 'newreg.ru'       => ['url' => 'https://www.newreg.ru/news/','type' => 'html', 'curl' => false],
    // 'profrc.ru'       => ['url' => 'https://profrc.ru/company/news/news-our/year/2022/','type' => 'html', 'curl' => false],
    // 'paritet.ru'      => ['url' => 'https://paritet.ru/all-news/','type' => 'html', 'curl' => false],
    // 'rtreg.ru'        => ['url' => 'https://rtreg.ru/posts', 'type' => 'html', 'curl' => true],
    // 'regkrc.ru'       => ['url' => 'https://regkrc.ru/news/', 'type' => 'html', 'curl' => false],
    // 'rostatus.ru'     => ['url' => 'https://rostatus.ru/about/news/', 'type' => 'html', 'curl' => false],
    // 'draga.ru'        => ['url' => 'https://draga.ru/topics/novosti/', 'type' => 'html', 'curl' => false],
    // 'a-rnr.ru'        => ['url' => 'https://www.a-rnr.ru/news/', 'type' => 'html', 'curl' => true],
    'vtbreg.ru'      => ['url' => 'https://www.vtbreg.ru/', 'type' => 'html', 'curl' => false],
    // ''      => ['url' => '', 'type' => 'html', 'curl' => false],
    
  ];
  
  $keywords = array_merge($words, $companies);
  
  // ------------------------- 

  $result_mas = ['message' =>'Данные для парсинга не были получены ', 'error' => true, 'result' => []];

  // Проходимся по всем сайтам
  foreach ($urls as $site => $url){
    $data = null;
    
    echo $site. "<br>";

    // Выбираем параметры и способ запроса
    if ($url['curl']){
      $data =  file_get_contents_curl($url['url']);
    } 
    else {
      $data = file_get_contents($url['url']);
    }  

    $parser = new siteParser($site, $url, $keywords);
    $tags = $parser->set_tags($site);


    // Проверяем заданы ли теги для этого сайта
    if($tags != null) {

      // Проверяем тип сайта html или JSON
      if ($data !== null && $url['type'] == 'html') { 

        $document_html = phpQuery::newDocument($data); 
        
        $parse_result = $parser->parse_HTML($document_html, $tags); 
        
        if(!$parse_result['error']){

          echo 'Сайт спарсен успешно <br><br>';

          $result_mas['message'] = $parse_result['message'];
          $result_mas['error'] = $parse_result['error'];
          $result_mas['result'][$site] = $parse_result['result']; 

          // dump($result_mas['result'][$site]);
        }
        else{
          echo 'При парсенге произошла ошибка: '. $parse_result['message'];
        }
        
      }
      elseif ($data !== null  && $url['type'] == 'json'){ 
        $parse_result = $parser->parse_JSON($data, $tags);
        if(!$parse_result['error']){

          echo 'Сайт спарсен успешно <br>';

          $result_mas['message'] = $parse_result['message'];
          $result_mas['error'] = $parse_result['error'];
          $result_mas['result'][$site] = $parse_result['result']; 
        }
        else{
          echo 'При парсенге произошла ошибка: '. $parse_result['message'];
        }
      }
    }
    else{
      echo "Ошибка! Нет данных (тегов) для парсинга сайта " . $site . "<br>";
    }
    
  } 
    
  return $result_mas;

}// start()
?>