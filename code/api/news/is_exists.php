<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов 
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/news.php';

// создание подключения к БД 
$database = new Database();
$db = $database->getConnection();

// инициализируем объект 
$news = new news($db);

if (isset($_POST["title"]) || isset($_POST["description"]) || isset($_POST["time"])){

}

// получаем ключевые слова 
$keywords = Array (
    'title'         => isset($_POST["title"]) ? $_POST["title"] : "",
    'description'   => isset($_POST["description"]) ? $_POST["description"] : "",
    'time'          => isset($_POST["time"]) ? $_POST["time"] : "",
);

// echo '<pre>';
// var_dump($keywords);
// echo '</pre>';

// Не более 3х параметров
if ( count($keywords) > 3 ) {
    // код ответа - 400 неверный запрос
    http_response_code(400);
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
} 
 
// запрос товаров 
$stmt = $news->is_exists($keywords);

$num = $stmt->fetch()[0];

// проверяем, найдено ли больше 0 записей 
if ($num ==  1) {

    // код ответа - 200 OK 
    http_response_code(200);

    // покажем товары 
    echo json_encode(true, JSON_UNESCAPED_UNICODE); 
}

elseif ($num == 0) {
    // код ответа - 404 Ничего не найдено 
    http_response_code(404);

    // скажем пользователю, что товары не найдены 
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(405);
    
    // скажем пользователю, что товары не найдены 
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}
?>