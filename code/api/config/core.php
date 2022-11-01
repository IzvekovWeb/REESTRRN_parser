<?php
// показывать сообщения об ошибках 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// URL домашней страницы 
$home_url="https://localhost/";

// страница указана в параметре URL, страница по умолчанию одна 
// $page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// установить часовой пояс по умолчанию 
date_default_timezone_set('Europe/Moscow');
 
// переменные, используемые для JWT 
$key = "old_granny-2r23rfijsdim21312";
$iss = "https://localhost";
$aud = "https://localhost";
$iat = 1356999524;
$nbf = 1357000000;
 

?>