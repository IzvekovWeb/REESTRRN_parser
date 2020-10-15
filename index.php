<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

require('functions.php');
require('libs/phpQuery/phpQuery.php');
require('libs/telegram/telegram.php');
require('parsers/SiteParser.php');

$t_bot = new Telegram();

for ($i = 0; $i < 6; $i++) {

  $result = start(); 

  if (!$result['error']){

    $new_news = Array();

    foreach ($result['result'] as $one_news){

      // dump($one_news);

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
    echo $result['error'];
  }

  sleep(10);
}


function start(){

  // Стартовые данные 
  // Позже будут в БД
  $urls = [
    'prnewswire.com'    => 'https://www.prnewswire.com/news-releases/news-releases-list/',
    'businesswire.com'  => 'https://www.businesswire.com/portal/site/home/news/',
    'globenewswire.com' => 'https://www.globenewswire.com/Index',
  ];
  $words = [
    'acquire','agreed to buy', 'reports preliminary', 'expecting record performance',
    'Acquire','Agreed To Buy', 'Reports Preliminary', 'Expecting Record Performance',
];
  $companies = ['Nike', 'Macerich', 'Tesla', 'Apple'];
  $keywords = array_merge($words, $companies);
  // -------------------------
  
  
  // Проходимся по всем сайтам
  foreach ($urls as $site => $url){


    $html = file_get_contents($url);
    $document = phpQuery::newDocument($html);
    
    $parser = new siteParser($site, $url, $keywords);

    $parced_news = [null, null, null];
    if($site == 'prnewswire.com'){ 
      
      $parced_news = $parser->parse($document); 

    }elseif ($site == 'businesswire.com'){
      

    }elseif ($site == 'globenewswire.com'){

    }

    break; 
  } 
  return $parced_news;
}



 

?>