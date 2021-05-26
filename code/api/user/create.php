<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных 
include_once '../config/database.php';

// создание объекта товара 
include_once '../objects/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new Userx($db);
    
    // получаем отправленные данные
    // $data = json_decode(file_get_contents("php://input"));

    // убеждаемся, что данные не пусты 


    $postData = file_get_contents('php://input');
    $data = json_decode($postData, true);

    if (
        !empty($data['loginx']) &&
        !empty($data['passwordx'])

    ) {
        $data = (Object)$data;

        // хешируем пароль
        $passwordx = password_hash($data->passwordx, PASSWORD_DEFAULT);

        // устанавливаем значения свойств пользователя 
        $user->loginx        = $data->loginx;
        $user->passwordx     = $passwordx;
        $user->first_name    = $data->first_name;
        $user->second_name   = $data->second_name;
        $user->status      = $data->status;
    
    
        // Проверим существует ли логин в БД
        if(!$user->loginExists()) { 

            // добавление в БД 
            if($user->create()){

                // установим код ответа - 201 создано 
                http_response_code(201);

                // сообщим пользователю 
                echo json_encode(array(
                    "message" => " успешно добавлен.",
                    "data" => $user
                ), JSON_UNESCAPED_UNICODE);
            }

            // если не удается создать товар, сообщим пользователю 
            else {

                // установим код ответа - 503 сервис недоступен 
                http_response_code(503);

                // сообщим пользователю 
                echo json_encode(array("message" => "При добавлении произошла ошибка."), JSON_UNESCAPED_UNICODE);
            }
        }
        else {

            // установим код ответа - 201 создано 
            http_response_code(404);

            // сообщим пользователю 
            echo json_encode(array("message" => "Такой логин уже существует"), JSON_UNESCAPED_UNICODE);
        }
    }

    // сообщим пользователю что данные неполные 
    else {

        // установим код ответа - 400 неверный запрос 
        http_response_code(400);

        // сообщим пользователю 
        echo json_encode(array("message" => "Невозможно добавить пользователя. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }
}else{
    // Обработка пред-запроса
    http_response_code(200);
    header("Content-Type: Content-Type: text/plain; charset=UTF-8");
}
?>