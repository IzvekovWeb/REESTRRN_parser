<?php
// заголовки 
header("Access-Control-Allow-Origin: http://test.newsparser.ru/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// подключение базы данных и файл, содержащий объекты 
include_once '../config/database.php';
include_once '../objects/user.php';
 
// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();
 
// создание объекта 'User' 
$user = new Userx($db);
 
// получаем данные 
$data = json_decode(file_get_contents("php://input"));
 
// устанавливаем значения 
$user->loginx = $data->loginx;
$login_exists = $user->loginExists();
 
// подключение файлов jwt 
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// существует ли электронная почта и соответствует ли пароль тому, что находится в базе данных 
if ( $login_exists && password_verify($data->passwordx, $user->passwordx) ) {
 
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
 
    // код ответа 
    http_response_code(200);
 
    // создание jwt 
    $jwt = JWT::encode($token, $key);
    echo json_encode(
        array(
            "message" => "Успешный вход в систему.",
            "jwt" => $jwt
        ),JSON_UNESCAPED_UNICODE
    );
 
}
 
// Если электронная почта не существует или пароль не совпадает, 
// сообщим пользователю, что он не может войти в систему 
else {
 
  // код ответа 
  http_response_code(401);

  // сказать пользователю что войти не удалось 
  echo json_encode(array("message" => "Ошибка входа."), JSON_UNESCAPED_UNICODE);
}
?>