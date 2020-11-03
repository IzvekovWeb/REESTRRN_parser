<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для работы с БД и объектом user 
include_once '../config/database.php';
include_once '../objects/user.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// подготовка объекта 
$user = new Userx($db);

// получаем id товара для редактирования 
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    
    // установим id свойства товара для редактирования 
    $user->id = $data->id;

    // устанавливаем значения свойств пользователя  
    if (!empty($data->passwordx) ) {
        // хешируем пароль
        $passwordx = password_hash($data->passwordx, PASSWORD_DEFAULT);
        $user->passwordx = $passwordx;
    }
    if (!empty($data->loginx) ) {
        $user->loginx = $data->loginx;
    }
    if (!empty($data->name) ) {
        $user->name = $data->name;
    }
    if (!empty($data->email) ) {
        $user->email = $data->email;
        $hash =  md5($data->email . time());
        $user->hash = $hash;
    }
    if (!empty($data->email_confirned) ) {
        $user->email_confirned = $data->email_confirned;
    } 
    

    // обновление товара 
    if ($user->update()) {

        // установим код ответа - 200 ok 
        http_response_code(200);

        // сообщим пользователю 
        echo json_encode(array("message" => "Пользовательская информация была обновлена."), JSON_UNESCAPED_UNICODE);
    }

    // если не удается обновить товар, сообщим пользователю 
    else {

        // код ответа - 503 Сервис не доступен 
        http_response_code(503);

        // сообщение пользователю 
        echo json_encode(array("message" => "Невозможно обновить данные пользователя."), JSON_UNESCAPED_UNICODE);
    }
}
else{
    
    // установим код ответа - 400 неверный запрос 
    http_response_code(400);

    // сообщим пользователю 
    echo json_encode(array("message" => "Невозможно обновить инфрпмацию о пользователе. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>