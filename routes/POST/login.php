<?php


// Файлы необходимые для соединения с БД
include_once "./classes/Database.php";
include_once "./classes/User.php";

// Получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// Создание объекта "User"
$user = new User($db);

// Получаем данные
$data = json_decode(file_get_contents("php://input"));

// var_dump($data -> name);
 
// Устанавливаем значения
$user->name = $data->name;
$name_exists = $user->nameExists();

 
// Подключение файлов JWT
include_once './config/core.php';
include_once './libs/php-jwt-main/src/BeforeValidException.php';
include_once './libs/php-jwt-main/src/ExpiredException.php';
include_once './libs/php-jwt-main/src/SignatureInvalidException.php';
include_once './libs/php-jwt-main/src/JWT.php';
use \Firebase\JWT\JWT;
 
// Существует ли имя пользователя и соответствует ли пароль тому, что находится в базе данных
if ($name_exists && $user->passworVerify($data->password, $user->password)) {
 
    

    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "exp" => $exp_time,
       "data" => array(
           "id" => $user->id,
           "name" => $user->name,
       )
    );
 
    // Код ответа
    http_response_code(200);
 
    // Создание jwt
    $jwt = JWT::encode($token, $key, 'HS256');
    echo json_encode(
        array(
            'id' => $user->id,
            "name" => $user->name,
            "jwt" => $jwt,
            "userLogo"=> $user->userLogo,
            "role"=> $user->role,
        )
    );
}
 
// Если имя поьлзователя не существует или пароль не совпадает,
// Сообщим пользователю, что он не может войти в систему
else {
 
  // Код ответа
  http_response_code(401);

  // Скажем пользователю что войти не удалось
  echo json_encode(array("message" => "Ошибка входа"));
}