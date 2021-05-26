<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для работы с БД и объектом news 
include_once '../config/database.php';
include_once '../objects/bot.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // получаем соединение с базой данных 
    $database = new Database();
    $db = $database->getConnection();

    // подготовка объекта 
    $bot = new Bot($db);

    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    if (
        !empty($data['chat_id']) &&
        !empty($data['user_id'])

    ) {
        $data = (Object)$data;  

        // установим id свойства товара для редактирования 
        $bot->chat_id = $data->chat_id;
        $bot->user_id = $data->user_id;
        $bot->last_message = $data->last_message;

        
        // обновление товара 
        if ($bot->update()) {

            // установим код ответа - 200 ok 
            http_response_code(200);

            // сообщим пользователю 
            echo json_encode(array("message" => "Запись была обновлена."), JSON_UNESCAPED_UNICODE);
        }

        // если не удается обновить товар, сообщим пользователю 
        else {

            // код ответа - 503 Сервис не доступен 
            http_response_code(503);

            // сообщение пользователю 
            echo json_encode(array("message" => "Невозможно обновить запись."), JSON_UNESCAPED_UNICODE);
        }
    // сообщим пользователю что данные неполные 
    }
    else {

        // установим код ответа - 400 неверный запрос 
        http_response_code(400);

        // сообщим пользователю 
        echo json_encode(array("message" => "Невозможно. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
}else{
    // Обработка пред-запроса
    http_response_code(200);
    header("Content-Type: Content-Type: text/plain; charset=UTF-8");
}
?>