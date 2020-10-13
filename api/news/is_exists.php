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

// получаем ключевые слова 
$keywords = Array (
    'title'         => isset($_POST["title"]) ? $_POST["title"] : "",
    'description'   => isset($_POST["description"]) ? $_POST["description"] : "",
    'time'          => isset($_POST["time"]) ? $_POST["time"] : "",
);

// Не более 3х параметров
if ( count($keywords) > 3 ) {
    // код ответа - 400 неверный запрос
    http_response_code(400);
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
} 

// запрос товаров 
$stmt = $news->search($keywords);
$num = $stmt->rowCount();
 

// проверяем, найдено ли больше 0 записей 
if ($num>0) {

    // код ответа - 200 OK 
    http_response_code(200);

    // покажем товары 
    echo json_encode(true, JSON_UNESCAPED_UNICODE);
}

else {
    // код ответа - 404 Ничего не найдено 
    http_response_code(404);

    // скажем пользователю, что товары не найдены 
    echo json_encode(false, JSON_UNESCAPED_UNICODE);
}
?>