<?php 

//======================================================================
// Тут я разместил все функции
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
      CURLOPT_URL => 'https://sasha-izvekov.ru/newsparser/api/news/create.php',
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
      CURLOPT_URL => 'https://sasha-izvekov.ru/newsparser/api/news/is_exists.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => http_build_query(array(
        'title'       => $news['title'],
        'description' => $news['desc'],
        'time'        => $news['time'],
      ))
  ));
  $response = curl_exec($check_news_bd);
  curl_close($check_news_bd);

  return $response;
}


/*
*  Функция: для дебага массивов и объектов
*  Вход: массив \ объект
*  Выход: 0
*/
function dump($r){
  echo "<pre>";
  var_dump($r);
  echo "</pre>";
} 

?>