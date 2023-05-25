<?php

// Файлы необходимые для соединения с БД
include_once "./classes/Database.php";  
include_once "./classes/History.php";

// Получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

$history = new History($db);

$data = json_decode(file_get_contents("php://input"));

$history->user_id = $data->user_id;
$history->prods = $data->prods;
$history->date = $data->date;

if ($history->create()) {
    // echo json_encode('1');
    http_response_code(200);
} else {
    http_response_code(400);
}