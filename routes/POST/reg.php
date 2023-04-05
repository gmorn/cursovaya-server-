<?php

include_once "./classes/Database.php";
include_once "./classes/User.php";

// Получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// Создание объекта "User"
$user = new User($db);
 
// Отправляемые данные будут здесь

$data = json_decode(file_get_contents("php://input"));
 
// Устанавливаем значения
$user->name = $data->name;
$user->password = $data->password;
 
// Создание пользователя
if (
    !empty($user->name) &&
    $user->create()
) {
    include 'login.php';


    // // Устанавливаем код ответа
    // http_response_code(200);
 
    // // Покажем сообщение о том, что пользователь был создан
    // echo json_encode(array("message" => "Пользователь был создан"));
}
 
// Сообщение, если не удаётся создать пользователя
else {
 
    // Устанавливаем код ответа
    http_response_code(400);
 
    // Покажем сообщение о том, что создать пользователя не удалось
    echo json_encode(array("message" => "Невозможно создать пользователя"));
}