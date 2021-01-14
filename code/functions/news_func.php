<?php 
//======================================================================
// Тут я разместил все функции связанные с новостями
//======================================================================


/*
*  Функция: добавить новость в БД
*  Вход: массив с 1 новостью
*  Выход: результат добавление
*/
function add_news_bd($news){

  // Добавление новости в БД
  $add_news_bd = curl_init();
  curl_setopt_array($add_news_bd, array(
      CURLOPT_URL => 'https://test.newsparser.ru/code/api/news/create.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => http_build_query(array(
        'title'       => $news['title'],
        'description' => $news['desc'],
        'site_link'   => $news['site_url'],
        'link'        => $news['link'],
        'time'        => $news['time'],
      ))
  ));
  $response = curl_exec($add_news_bd);
  curl_close($add_news_bd);

  return $response;

}

/*
*  Функция: есть ли запись в БД
*  Вход: массив с 1 новостью
*  Выход: true \ false
*/
function is_news_exist_bd($news){

  // Проверка: ксть ли новости в БД
  $check_news_bd = curl_init();

  curl_setopt_array($check_news_bd, array(
      CURLOPT_URL => 'https://test.newsparser.ru/code/api/news/is_exists.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => http_build_query(array(
        'title'       => htmlspecialchars(strip_tags($news['title'])),
        'description' => htmlspecialchars(strip_tags($news['desc'])),
        'time'        => htmlspecialchars(strip_tags($news['time'])),
      ))
  ));
  $response = curl_exec($check_news_bd);
  curl_close($check_news_bd);
 
  return $response;
}

/*
*  Функция: CURL скачивание сайта
*  Вход: url Сайта
*  Выход: массив содержимого страницы
*/
function file_get_contents_curl($url) {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);     
  curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');   

  $data = curl_exec($ch);

  if($data === false)
  {
      echo 'Ошибка curl: ' . curl_error($ch);
  }

  curl_close($ch);

  return $data;
}


/*
*  Функция: Перевод текста с помощью яндекс переводчика
*  Вход: текст
*  Выход: переведенный текст
*/
function translate_text($text) {

  $params = [
    "targetLanguageCode"=> "ru",
    "folderId"=> "b1gauh5r1caqlblhsvd8",
    "texts"=> [
      $text
    ],
  ];
  $data_string = json_encode($params, JSON_UNESCAPED_UNICODE);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, "https://translate.api.cloud.yandex.net/translate/v2/translate");
  // curl_setopt($ch, CURLOPT_URL, "https://translate.api.cloud.yandex.net/translate/v2/languages");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);    
  curl_setopt($ch, CURLOPT_POST, TRUE);    
  curl_setopt($ch, CURLOPT_HTTPHEADER,
    array(
        'Content-Type:application/json',
        'Authorization: Bearer t1.9euelZqYj4uJx52cnZ2ZnpWJjJ6Sje3rnpWayJHNisaNjZuVmMmals2Yl83l9PdtSxQA-u8XThfT3fT3LXoRAPrvF04X0w.ZPtOLPv5bIwgOAt9KH1zxlJOrzIZeayiIq7I6bgimQIEWqviEH1UO-fWtP_XDIUd-3ogANbqe3K00VYi4zJZAA'
    )
); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
  $result = curl_exec($ch);

  if($result === false)
  {
      echo 'Ошибка curl: ' . curl_error($ch);
  }
  curl_close($ch);

  // Формирует ответ в виде строки
  $result = json_decode($result, JSON_OBJECT_AS_ARRAY );
  $result = $result['translations'][0]['text'];
  
  return $result;
}
  


/*
*  Функция: Перебирает массив новостей, отправляет текст новости на перевод, формирует массив переведенных новостей
*  Вход: массив не переведенных новостей
*  Выход: массив новостей на русском
*/
function translate_news($news) {
  foreach($news as $article){
    $article['title'] = translate_text($article['title']);
    if(!empty($article['desc']) && $article['desc'] != null){
      $article['desc'] = translate_text($article['desc']);
    } 
    // echo "<pre>";
    // var_dump($article);
    // echo "</pre>";
  }
}


?>