<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require('phpQuery/phpQuery.php');
require('sendNews/telegram.php');
require('sites/SiteParser.php');


for ($i = 0; $i < 5; $i++) {

  $result = start();

  if (!$result['error']){
    $t_bot = new Telegram();
    $t_bot->send_message($t_bot->create_message($result['result']));
  

    // json_encode($values, JSON_PRETTY_PRINT)
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
  $words = ['acquire','tender', 'COVID', 'Technology'];
  $companies = ['nike', 'macerich', 'tesla', 'apple'];
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








function dump($r){
  echo "<pre>";
  var_dump($r);
  echo "</pre>";
}  

?>