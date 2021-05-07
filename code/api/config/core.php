<?php
// показывать сообщения об ошибках 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// URL домашней страницы 
$home_url="https://test.newsparser.ru/";

// страница указана в параметре URL, страница по умолчанию одна 
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// показывать сообщения об ошибках 
error_reporting(E_ALL);
 
// установить часовой пояс по умолчанию 
date_default_timezone_set('Europe/Moscow');
 
// переменные, используемые для JWT 
$key = "old_granny-2r23rfijsdim21312";
$iss = "https://sasha-izvekov.ru";
$aud = "https://newsparser.ru";
$iat = 1356999524;
$nbf = 1357000000;
 

?>