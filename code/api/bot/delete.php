<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных 
include_once '../config/database.php';

// создание объекта товара 
include_once '../objects/bot.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $database = new Database();
  $db = $database->getConnection();

  $bot = new Bot($db);
  
  // получаем отправленные данные 
  $postData = file_get_contents('php://input');
  $data = json_decode($postData, true);
  // убеждаемся, что данные не пусты 
 
  
  if (!empty($data['chat_id']) &&
      !empty($data['user_id']) ) 
  {
    $data = (Object)$data;

    // устанавливаем значения свойств товара 
    $bot->chat_id = $data->chat_id;
    $bot->user_id = $data->user_id;
 
    // удаление товара 
    if ($bot->delete()) {

        // код ответа - 200 ok 
        http_response_code(200);

        // сообщение пользователю 
        echo json_encode(array("message" => "Запись была удалена."), JSON_UNESCAPED_UNICODE);
    }

    // если не удается удалить товар 
    else {

        // код ответа - 503 Сервис не доступен 
        http_response_code(503);

        // сообщим об этом пользователю 
        echo json_encode(array("message" => "Не удалось удалить запись."), JSON_UNESCAPED_UNICODE);
    }
  }
  // сообщим пользователю что данные неполные 
  else {

    // установим код ответа - 400 неверный запрос 
    http_response_code(400);

    // сообщим пользователю 
    echo json_encode(array("message" => "Невозможно удалить запись. Данные неполные."), JSON_UNESCAPED_UNICODE);}
}else{
  // Обработка пред-запроса
  http_response_code(200);
  header("Content-Type: Content-Type: text/plain; charset=UTF-8");
}
?>