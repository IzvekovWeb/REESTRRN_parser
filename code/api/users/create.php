<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: https://sasha-izvekov.ru/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// получаем соединение с базой данных 
include_once '../config/database.php';

// создание объекта товара 
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new Userx($db);
 
// получаем отправленные данные 
$data = $_POST;
 

// убеждаемся, что данные не пусты 
 
if (
    !empty($data['loginx']) &&
    !empty($data['passwordx']) &&
    !empty($data['email']) 
) {
    $data = (Object)$data;

    // хешируем пароль
    $passwordx = password_hash($data->passwordx, PASSWORD_DEFAULT);

    // создаём уникальный хеш для подтверждения email
    $hash =  md5($data->loginx . time());

    // устанавливаем значения свойств пользователя 
    $user->loginx        = $data->loginx;
    $user->passwordx     = $passwordx;
    $user->name          = $data->name;
    $user->email         = $data->email;
    $user->hash          = $hash;
    $user->email_confirned   = 0;
    $user->reg_date      = $data->reg_date;

    // создание новости \ добавление в БД 
    if($user->create()){

        // установим код ответа - 201 создано 
        http_response_code(201);

        // сообщим пользователю 
        echo json_encode(array("message" => "Пользователь успешно добавлен."), JSON_UNESCAPED_UNICODE);
    }

    // если не удается создать товар, сообщим пользователю 
    else {

        // установим код ответа - 503 сервис недоступен 
        http_response_code(503);

        // сообщим пользователю 
        echo json_encode(array("message" => "При добавлении произошла ошибка."), JSON_UNESCAPED_UNICODE);
    }
}

// сообщим пользователю что данные неполные 
else {

    // установим код ответа - 400 неверный запрос 
    http_response_code(400);

    // сообщим пользователю 
    echo json_encode(array("message" => "Невозможно добавить пользователя. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>