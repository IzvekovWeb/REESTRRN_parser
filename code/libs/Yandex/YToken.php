<?php 
require_once('MyFiles.php');

class YToken {
 

  /*
  *  Функция: Получение API Токена от Yandex
  *  Вход: текст
  *  Выход: json (токен, дата)
  */
  public static function get_token_from_API(){

    $params = [
      "yandexPassportOauthToken"=> "AgAAAABLmM0bAATuwXZTUaoGRUxOvK8-WVefIfo",
    ];
    $data_string = json_encode($params, JSON_UNESCAPED_UNICODE);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, "https://iam.api.cloud.yandex.net/iam/v1/tokens");
    // curl_setopt($ch, CURLOPT_URL, "https://translate.api.cloud.yandex.net/translate/v2/languages");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);    
    curl_setopt($ch, CURLOPT_POST, TRUE);  
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response)->iamToken;
  } 

  

  /*
  *  Функция: создает файл и записывает в него токен от Яндекса
  *  Вход: токен
  *  Выход: boolean
  */
  public function save_token_to_file($token){
    if (file_put_contents( dirname(__FILE__) . '/_YandexApiToken_' . date('Ymd-mis') .'.txt' , $token) == 'false') 
      return false; 
    return true;
  }

  /*
  *  Функция: получаем токен из последнего созданого файла
  *  Вход: 
  *  Выход: токен
  */
  public function get_token_from_file(){
    
    $files = Files::get_all_files(dirname(__FILE__), 'txt');
    krsort($files);  

    if(!empty($files)) {
      
      $file_url = 'https://test.newsparser.ru/code/libs/Yandex/';

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $file_url  . $files[array_key_first($files)]);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);    
      curl_setopt($ch, CURLOPT_POST, TRUE);  
      $response = curl_exec($ch);
      curl_close($ch);
   
      $token = $response ;
    }
    return $token;
  }

  // echo "<pre>";
  // var_dump($files);
  // echo "</pre>";
}