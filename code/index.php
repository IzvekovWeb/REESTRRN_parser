<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

require('functions/news_func.php');
require('functions/function.php');
require('libs/phpQuery/phpQuery.php');
require('libs/telegram/TelegramBot.php');
require('parsers/SiteParser.php');
 
file_put_contents('log.txt', 'Программа запущена ' . date('Y-m-d H:i:s') . '<br>', FILE_APPEND);

$t_bot = new Telegram();
$new_news_companies = Array();
$new_news_words = Array();

$words = [
  // 'covid', 'sale', 'and', 'Free', 'By', 'to'
];
$companies = ['Nike', 'Macerich', 'Tesla', 'trends', 'and', 'Free', 'By', 'to'];
 

// for ($i = 0; $i < 6; $i++) {
  $start_time =  microtime(true);

  $result = start($words, $companies); 
 
  // dump($result);
  if (!$result['error']){ 

    if (count($result['result']) > 0) {
      
      // dump($result);


      // Проходимяся по сайтам
      foreach ($result['result'] as $site => $cur_site_news){ 

        echo $site . '<br>';

        if(count($cur_site_news) > 0) {
          // Проходимся по новостям на конкретном сайте
          foreach ($cur_site_news as  $one_news){ 

            // Отсеиваем уже добавленный\отправленные новости
            if (is_news_exist_bd($one_news) == 'true') {

              echo "Такая новость уже есть - ".$one_news['title'] ."<br>"; 
              //continue;

            }else{
              echo "Такой новости нет - ".$one_news['title'] ."<br>"; 

              if ($one_news != null) {
                // Добавляем новость в бд
                add_news_bd($one_news);
                
                // Проверим на совпадение ключа с КЛЮЧЕВЫМИ СЛОВАМИ
                $inter_mas = array_intersect($words, $one_news['keywords']);

                // Если найдено по "словам" то отправляем в общий чат, иначе в обычный
                if(count($inter_mas) > 0) {
                  array_push($new_news_words, $one_news); 
                }else {
                  array_push($new_news_companies, $one_news); 
                } 
              }
            } 

          } //foreach
        } //if
      } //foreach

      // dump($new_news_companies);
      // dump($new_news_words);

      // Отправляем в группу по КОМПАНИЯМ ттолько новые новости
      if(!empty($new_news_companies) && count($new_news_companies) > 0){
        $t_bot->send_message($t_bot->create_message($new_news_companies), -465108518);
        $new_news_companies = [];
      } 

      // Отправляем в группу по СЛОВАМ ттолько новые новости
      if(!empty($new_news_words) && count($new_news_words) > 0 ){
        $t_bot->send_message($t_bot->create_message($new_news_words), -478273397);
        $new_news_words = [];
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
 
file_put_contents('log.txt', 'Программа зевершена ' . date('"Y-m-d H:i:s"') . '<br><br>', FILE_APPEND);



function start($words, $companies){

  // Стартовые данные 
  // Позже будут в БД
  $urls = [
    'globenewswire.com'    => ['url' => 'https://www.globenewswire.com/Index','type' => 'html'],
    'prnewswire.com'       => ['url' => 'https://www.prnewswire.com/news-releases/news-releases-list/','type' => 'html'],
    'businesswire.com'     => ['url' => 'https://www.businesswire.com/portal/site/home/news/','type' =>  'html'],
    'finance.yahoo.com'    => ['url' => 'https://finance.yahoo.com/news/','type' =>  'html'],
    'barrons.com'          => ['url' => 'https://www.barrons.com/topics/markets','type' =>  'html'],
    'streetinsider.com'    => ['url' => 'https://www.streetinsider.com/dr/ajax.php?a=basic_latest_news&type=top','type' => 'json'],
    'seekingalpha.com'     => ['url' => 'https://seekingalpha.com/market-news/all','type' => 'html'],
    'fda.gov'              => ['url' => 'https://www.fda.gov/news-events/fda-newsroom/press-announcements','type' =>  'html'],
    'mobile.reuters.com'   => ['url' => 'https://mobile.reuters.com/finance/markets','type' =>  'html'],
    'wsj.com'              => ['url' => 'https://www.wsj.com/news/latest-headlines?mod=wsjheader','type' =>  'html'],
    'thefly.com'           => ['url' => 'https://thefly.com/news.php','type' =>  'html'],

    // 'bloomberg.com'     => ['url' => 'https://www.bloomberg.com/deals','type' =>  'html'], // Вылезает капча
    // 'cnbc.com'          => ['url' => 'https://www.cnbc.com/markets/','type' =>  'html'], // json - защищен, а сайт не парсится (ощибка сервера)
     
  
    /*
    
    https://www.docwirenews.com
    https://www.channelnewsasia.com/news/business
    */
    
  ];
  
  $keywords = array_merge($words, $companies);
  // ------------------------- 

  $result_mas = ['message' =>'Данные для парсинга не были получены ', 'error' => true, 'result' => []];

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

    $parser = new siteParser($site, $url, $keywords);
    $tags = $parser->set_tags($site);


    // Проверяем заданы ли теги для этого сайта
    if($tags != null) {

      // Проверяем тип сайта html или JSON
      if ($html !== null && $url['type'] == 'html') { 

        $document_html = phpQuery::newDocument($html); 
        
        $parse_result = $parser->parse_HTML($document_html, $tags); 
        if(!$parse_result['error']){

          echo 'Сайт спарсен успешно <br><br>';

          $result_mas['message'] = $parse_result['message'];
          $result_mas['error'] = $parse_result['error'];
          $result_mas['result'][$site] = $parse_result['result']; 
        }
        else{
          echo 'При парсенге произошла ошибка: '. $parse_result['message'];
        }
        
      }
      elseif ($json !== null  && $url['type'] == 'json'){ 
        $parse_result = $parser->parse_JSON($json, $tags);
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