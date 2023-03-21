<?php

// Требуется для декодирования JWT
include_once "config/core.php";
include_once './libs/php-jwt-main/src/BeforeValidException.php';
include_once './libs/php-jwt-main/src/ExpiredException.php';
include_once './libs/php-jwt-main/src/SignatureInvalidException.php';
include_once './libs/php-jwt-main/src/JWT.php';
include_once "./libs/php-jwt-main/src/Key.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key; 
 
// Получаем значение веб-токена JSON
$data = json_decode(file_get_contents("php://input"));

// Получаем JWT
$jwt = isset($data->jwt) ? $data->jwt : "";


// Если JWT не пуст
if ($jwt) {
 
    // Если декодирование выполнено успешно, показать данные пользователя
    try {

        // Декодирование jwt
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
 
        // Код ответа
        http_response_code(200);
 
        // Покажем детали
        echo json_encode(array(
            "message" => "Доступ разрешен",
            "data" => $decoded->data
        ));
    }
 
    // Если декодирование не удалось, это означает, что JWT является недействительным
    catch (Exception $e) {
    
        // Код ответа
        http_response_code(200);

        if ($name_exists && $user->passworVerify($data->password, $user->password)) {
            
        }


        $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp_time,
            "data" => array(
                "id" => $user->id,
                "name" => $user->name
            )
         );

        $jwt = JWT::encode($token, $key, 'HS256');
        echo json_encode(
            array(
                "message" => "Ваш новый токен",
                "jwt" => $jwt
            )
        );
    
        // Сообщим пользователю что ему отказано в доступе и покажем сообщение об ошибке
        // echo json_encode(array(
        //     "message" => "Вам доступ закрыт",
        //     "error" => $e->getMessage()
        // ));
    }
}
 
// Покажем сообщение об ошибке, если JWT пуст
else {
 
    // Код ответа
    http_response_code(401);
 
    // Сообщим пользователю что доступ запрещен
    echo json_encode(array("message" => "Доступ запрещён"));
}