<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

require('functions/news_func.php');
require('functions/function.php');
require('libs/phpQuery/phpQuery.php');
require('libs/telegram/telegram.php');
require('parsers/SiteParser.php');

$t_bot = new Telegram();
$new_news = Array();

// for ($i = 0; $i < 6; $i++) {
  $start_time =  microtime(true);

  $result = start(); 
 
  if (!$result['error']){ 

    if (count($result['result']) > 0) {
      
      foreach ($result['result'] as $one_news){ 

        // Если новость уже есть в БД, идём дальше
        if (is_news_exist_bd($one_news) == 'true') {

          echo "Такая новость уже есть - ".$one_news['title'] ."<br>"; 
          //continue;

        }else{
          echo "Такой новости нет - ".$one_news['title'] ."<br>"; 

          if ($one_news != null) {
            // Добавляем новость в бд
            add_news_bd($one_news);
            // Добавляем новость в массив с новыми новостями
              
            array_push($new_news, $one_news); 
          }
        } 
      }   
      if(!empty($new_news) && count($new_news) > 0){
        // Отправляем в телеграмттолько новые новости
        $t_bot->send_message($t_bot->create_message($new_news));
      } 
    }
    else  {
      echo "В данный момент нет подходящих новостей" . PHP_EOL;
    }

  }
  else{
    echo $result['message'] . PHP_EOL;
  } 
  echo "<br> Парсинг занял: " . round(microtime(true) - $start_time, 4) . " сек.<br>";
//   sleep(10);
// }


function start(){

  // Стартовые данные 
  // Позже будут в БД
  $urls = [
    'globenewswire.com' => ['url' => 'https://www.globenewswire.com/Index','type' => 'html'],
    'prnewswire.com'    => ['url' => 'https://www.prnewswire.com/news-releases/news-releases-list/','type' => 'html'],
    'businesswire.com'  => ['url' => 'https://www.businesswire.com/portal/site/home/news/','type' =>  'html'],
    'finance.yahoo.com' => ['url' => 'https://finance.yahoo.com/news/','type' =>  'html'],
    'barrons.com'       => ['url' =>'https://www.barrons.com/topics/markets','type' =>  'html'],


    'streetinsider.com'     => ['url' => 'https://www.streetinsider.com/dr/ajax.php?a=basic_latest_news&type=top','type' => 'json'],
    
    // 'bloomberg.com'    => 'https://www.bloomberg.com/deals',
    // 'cnbc.com' => 'https://www.cnbc.com/markets/',
    
    // 'bloomberg.com' => 'https://www.bloomberg.com/markets/stocks/world-indexes/americas',
    // 'seekingalpha.com' => 'https://seekingalpha.com/market-news/all',
    // '' => '',
    // '' => '',
    // '' => '',

    /*
    https://www.cnbc.com/business/
    
    https://www.fda.gov/news-events/fda-newsroom/press-announcements
     
    https://mobile.reuters.com/finance/markets
    https://www.wsj.com/news/latest-headlines?mod=wsjheader
    https://thefly.com/news.php
    https://www.docwirenews.com
    https://www.channelnewsasia.com/news/business
    */
    
  ];
  $words = [
    'acquire', 'global'
  ];
  $companies = ['Nike', 'Macerich', 'Tesla', 'trends'];
  $keywords = array_merge($words, $companies);
  // -------------------------
  


  // Проходимся по всем сайтам
  foreach ($urls as $site => $url){
    $html = null;
    $json = null;
    
    echo $site. "<br>";

    // Выбираем параметры и способ запроса
    if ($site == "businesswire.com") {
      $opts = array('http' => array(
        "authority" => "cdn.cookielaw.org",
        "method"=>  "GET",
        "path" => "/consent/a2007379-c22b-41e8-8743-1bbfd2cbb24a/a2007379-c22b-41e8-8743-1bbfd2cbb24a.json",
        "scheme" => "https",
        "method" => "GET",
        "header" => 'accept:*/*'
        ."accept-encoding: gzip, deflate, br"
        ."accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7"
        ."cache-control: no-cache"
        ."dnt: 1"
        ."origin: https://www.businesswire.com"
        ."pragma: no-cache"
        ."referer: https://www.businesswire.com/portal/site/home/news/"
        ."sec-fetch-dest: empty"
        ."sec-fetch-mode: cors"
        ."sec-fetch-site: cross-site"
        ."user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36"
        ));
        
    $context = stream_context_create($opts); 
    $html = file_get_contents($url['url'],false,$context);
      
    }
    elseif ($url['type'] == 'json'){
       
      $json =  file_get_contents_curl($url['url']);
    } 
    else {
      
    
      $html = file_get_contents($url['url']);
    
    }  

    $result_mas = ['message' =>'Данные для парсинга не были получены с '. $site, 'error' => true, 'result' => []];

    $parser = new siteParser($site, $url, $keywords);
    $tags = $parser->set_tags($site);

    // Проверяем заданы ли теги для этого сайта
    if($tags != null) {

      // Проверяем тип сайта html или JSON
      if ($html !== null && $url['type'] == 'html') {

        $document_html = phpQuery::newDocument($html);
        $result_mas = pritify_result($parser->parse_HTML($document_html, $tags));
        
      }
      elseif ($json !== null  && $url['type'] == 'json'){ 
        $result_mas = pritify_result($parser->parse_JSON($json, $tags));
      }
    }
    else{
      echo "Ошибка! Нет данных (тегов) для парсинга сайта " . $site . "<br>";
    }
    
  } 
    
  return $result_mas;

}// start()


/* 
*-------------------------
*---- Формирует массив полученных новостей
*-------------------------
*/
function pritify_result($result) {
  $parced_news = [];
  $result_mas = ['message' =>'Неизвестная ошибка', 'error' => true, 'result' => []];


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
  
  $result_mas['result'] = $parced_news;
    
  return $result_mas;
    
} //pritify_result()

 

?>