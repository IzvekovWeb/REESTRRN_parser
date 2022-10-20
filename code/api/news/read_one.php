<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// подключение файла для соединения с базой и файл с объектом 
include_once '../config/database.php';
include_once '../objects/news.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// подготовка объекта 
$news = new news($db);

// установим свойство ID записи для чтения 
$news->id = isset($_GET['id']) ? $_GET['id'] : die();

// прочитаем детали товара для редактирования 
$news->readOne();

if ($news->title!=null) {

    // создание массива 
    $news_arr = array(
        "id" =>  $news->id,
        "title" => $news->title,
        "description" => $news->description,
        "link" => $news->link,
        "site_link" => $news->site_link,
        "time" => $news->time
    );

    // код ответа - 200 OK 
    http_response_code(200);

    // вывод в формате json 
    echo json_encode($news_arr);
}

else {
    // код ответа - 404 Не найдено 
    http_response_code(404);

    // сообщим пользователю, что товар не существует 
    echo json_encode(array("message" => "Запись не существует."), JSON_UNESCAPED_UNICODE);
}
?>