<?php
/*
  В этой файле настроен скрипт получения токена для Яндекс.Облака.
  Запускается через cron каждые 10 часов
  Записывает токен в соответствуйщий файл
  Удаляет старые файлы с токенами(более 3х)
*/

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('../libs/Yandex/YToken.php');
// require_once('../libs/Yandex/MyFiles.php');
  
$t = new YToken(); 
$f = new Files(); 

$token = $t->get_token_from_API();

$t->save_token_to_file($token);

$f->delete_old_files($f->get_all_files(dirname(__FILE__),'txt'));