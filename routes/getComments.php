<?php

// Файлы необходимые для соединения с БД
include_once('./classes/Database.php');

$q = $_GET['q'];
$params = explode('/', $q);

$id_prod = $params[1];

// Получаем соединение с базой данных
$database = new Database();
$conn = $database->getConnection();

$query = "SELECT * FROM `comments` WHERE id_user = $id_prod";

// запрос на получние всех товаров
$result = $conn->query($query);

$resultArr = [];
$i = 0;

while($row = $result->fetch()){
    $resultArr[$i] = array(
        "id" => $row["id"],
        "name" => $row["id_user"],
        "price" => $row["id_prod"],
        "gallery" => $row["description"],
        "category" => $row["rating"],
     );

     echo $resultArr[$i]['id'];

    $i++;
}
