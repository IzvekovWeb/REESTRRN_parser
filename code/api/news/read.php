<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение базы данных и файл, содержащий объекты 
include_once '../config/database.php';
include_once '../objects/news.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// инициализируем объект 
$news = new News($db);
 
// запрашиваем товары 
$stmt = $news->read();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей 
if ($num>0) {

    // массив работ 
    $news_arr=array();
    $news_arr["records"]=array();

    // получаем содержимое нашей таблицы 
    // fetch() быстрее, чем fetchAll() 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $news_item=array(
            "id" => $id,
            "title" => $title,
            "description" => html_entity_decode($description),
            "link" => $link,
            "site_link" => $site_link,
            "time" => $time
        );

        array_push($news_arr["records"], $news_item);
    }

    // устанавливаем код ответа - 200 OK 
    http_response_code(200);

    // выводим данные о товаре в формате JSON 
    echo json_encode($news_arr, JSON_UNESCAPED_UNICODE);
}

else {

  // установим код ответа - 404 Не найдено 
  http_response_code(404);

  // сообщаем пользователю, что товары не найдены 
  echo json_encode(array("message" => "Работы не найдены."), JSON_UNESCAPED_UNICODE);
}