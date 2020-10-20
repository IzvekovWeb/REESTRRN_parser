<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

require('functions.php');
require('libs/phpQuery/phpQuery.php');
require('libs/telegram/telegram.php');
require('parsers/SiteParser.php');

$t_bot = new Telegram();

for ($i = 0; $i < 6; $i++) {
  $start_time =  microtime(true);

  $result = start(); 


  if (!$result['error']){ 

    $new_news = Array();

    foreach ($result['result'] as $one_news){

      // Если новость уже есть в БД, идём дальше
      if (is_news_exist_bd($one_news) == 'true') {
        echo "Такая новость уже есть - ".$one_news['title'] ."<br>";
        //continue;
      }else{
        echo "Такой новости нет - ".$one_news['title'] ."<br>";

        // Добавляем новость в бд
        add_news_bd($one_news);
        // Добавляем новость в массив с новыми новостями
        array_push($new_news, $one_news);

      } 
    }  
    if(!empty($new_news)){
      // Отправляем в телеграмттолько новые новости
      $t_bot->send_message($t_bot->create_message($new_news));
    }

  }
  else{
    echo $result['message'] . PHP_EOL;
  } 
  echo "<br> Парсинг занял: " . round(microtime(true) - $start_time, 4) . " сек.<br>";
  sleep(10);
}


function start(){

  // Стартовые данные 
  // Позже будут в БД
  $urls = [
    'globenewswire.com' => 'https://www.globenewswire.com/Index',
    'prnewswire.com'    => 'https://www.prnewswire.com/news-releases/news-releases-list/',
    'businesswire.com'  => 'https://www.businesswire.com/portal/site/home/news/',
    
  ];
  $words = [
    'acquire','agreed to buy', 'reports preliminary', 'expecting record performance', 'Technology', 'covid', 'global'
  ];
  $companies = ['Nike', 'Macerich', 'Tesla', 'Apple'];
  $keywords = array_merge($words, $companies);
  // -------------------------
  
  
  
  $parced_news = [];
  $result_mas = ['message' =>'Неизвестная ошибка', 'error' => true, 'result' => []];

  // Проходимся по всем сайтам
  foreach ($urls as $site => $url){

    $html = file_get_contents($url);
    $document = phpQuery::newDocument($html);
    
    $parser = new siteParser($site, $url, $keywords);
     
    $tags = $parser->set_tags($site);
    
    
    if($tags != null) {

      $result = $parser->parse($document, $tags);

      if(!$result['error']){
        $i = 0;
        foreach ($result['result'] as $one_parced_news){
          array_push($parced_news, $one_parced_news);
          $i++;
        } 

        $result_mas['message']  = 'Хотя бы 1 сайт спарсен успешно';
        $result_mas['error']    = false;

      }
      else{
        echo "ПРОВАЛ!" . '<br>';
        echo $result['message'] . $site . PHP_EOL;
      }
    }
    else{
      echo "Ошибка! Нет данных (тегов) для парсинга сайта " . $site . "<br>";
    }
  } 

  $result_mas['result'] = $parced_news;
 
  return $result_mas;
}

?>