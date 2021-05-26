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

    // инициализируем объект 
    $bot = new Bot($db);

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    if (
        !empty($data['chat_id']) &&
        !empty($data['user_id'])

    ) {
        $data = (Object)$data;  
       // устанавливаем значения свойств товара 
      $bot->chat_id = $data->chat_id;
      $bot->user_id = $data->user_id;
 
        
      if($bot->isExists()){ 
         
        // echo json_encode(array("message" => "Такая запись уже есть"), JSON_UNESCAPED_UNICODE);
        
        return true;
      }
      // если не удается проверить запись, сообщим пользователю 
      else {
 
          // установим код ответа - 503 сервис недоступен 
        //   http_response_code(503);


          // сообщим пользователю 
          echo json_encode(array("message" => "Такой записи нет"), JSON_UNESCAPED_UNICODE);
          
          return false;
      }
  }

  // сообщим пользователю что данные неполные 
  else {

      // установим код ответа - 400 неверный запрос 
      http_response_code(400); 

      // сообщим пользователю 
      echo json_encode(array("message" => "Невозможно проверить запись. Данные неполные."), JSON_UNESCAPED_UNICODE);
  }
}else{
    // Обработка пред-запроса
    http_response_code(200);
    header("Content-Type: Content-Type: text/plain; charset=UTF-8");
}
?>