<?php
// required headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// требуется для кодирования веб-токена JSON 
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// файлы, необходимые для подключения к базе данных 
include_once '../config/database.php';
include_once '../objects/user.php';
 
// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();
 
// создание объекта 'User' 
$user = new Userx($db);
 
// получаем данные 
$data = json_decode(file_get_contents("php://input"));
 
// получаем jwt 
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// если JWT не пуст 
if($jwt) {
 
    // если декодирование выполнено успешно, показать данные пользователя 
    try {
 
        // декодирование jwt 
        $decoded = JWT::decode($jwt, $key, array('HS256'));
 
        // Нам нужно установить отправленные данные (через форму HTML) в свойствах объекта пользователя 
       
        $user->id = $decoded->data->id;
        $user->first_name = $data->first_name;
        $user->second_name = $data->second_name;
        $user->loginx = $data->loginx;
        $user->status = $decoded->data->status;
        $user->reg_date = $decoded->data->reg_date;
        // $user->passwordx = $data->passwordx;
        
        // создание пользователя 
        if($user->update()) {

            // нам нужно заново сгенерировать JWT, потому что данные пользователя могут отличаться 
            $token = array(
                "iss" => $iss,
                "aud" => $aud,
                "iat" => $iat,
                "nbf" => $nbf,
                "data" => array(
                    "id" => $user->id,
                    "first_name" => $user->first_name,
                    "second_name" => $user->second_name,
                    "loginx" => $user->loginx,
                    "status" => $user->status,
                    "reg_date" => $user->reg_date,
                )
            );
            $jwt = JWT::encode($token, $key);
            
            // код ответа 
            http_response_code(200);
            
            // ответ в формате JSON 
            echo json_encode(
                array(
                    "message" => "Пользователь был обновлён",
                    "jwt" => $jwt
                ), JSON_UNESCAPED_UNICODE
            );
        }
        
        // сообщение, если не удается обновить пользователя 
        else {
            // код ответа 
            http_response_code(401);
        
            // показать сообщение об ошибке 
            echo json_encode(array("message" => "Невозможно обновить пользователя."), JSON_UNESCAPED_UNICODE);
        }
    }
 
    // если декодирование не удалось, это означает, что JWT является недействительным 
    catch (Exception $e){
    
        // код ответа 
        http_response_code(401);
    
        // сообщение об ошибке 
        echo json_encode(array(
            "message" => "Доступ закрыт",
            "error" => $e->getMessage()
        ), JSON_UNESCAPED_UNICODE);
    }
}

// показать сообщение об ошибке, если jwt пуст 
else {
 
    // код ответа 
    http_response_code(401);
 
    // сообщить пользователю что доступ запрещен 
    echo json_encode(array("message" => "Доступ закрыт."), JSON_UNESCAPED_UNICODE);
}
?>