<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключение файла для соединения с базой и файл с объектом 
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

        // устанавливаем значения 
        $bot->chat_id = $data->chat_id;
        $bot->user_id = $data->user_id;

        if ($bot->readOne()) {

            // создание массива 
            $bot_arr = array(
                "chat_id" =>  $bot->chat_id,
                "user_id" => $bot->user_id,
                "last_message" => $bot->last_message
            );

            // код ответа - 200 OK 
            http_response_code(200);

            // вывод в формате json 
            echo json_encode($bot_arr);
        }

        else {
            // код ответа - 404 Не найдено 
            http_response_code(404);

            // сообщим пользователю, что товар не существует 
            echo json_encode(array("message" => "Запись не найдена."), JSON_UNESCAPED_UNICODE);
        }
    }
    // сообщим пользователю что данные неполные 
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