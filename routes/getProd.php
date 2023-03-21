<?php

// die('test');
// Файлы необходимые для соединения с БД
// include_once "./classes/Database.php";
include_once('./classes/Database.php');

// Получаем соединение с базой данных
$database = new Database();
$conn = $database->getConnection();

$query = "SELECT * FROM `products`";


// запрос на получние всех товаров
$result = $conn->query($query);

$resultArr = [];
$i = 0;


while($row = $result->fetch()){
	$name = $row["price"];

    $resultArr[$i] = array(
        "id" => $row["id"],
        "name" => $row["name"],
        "price" => $row["price"],
        "gallery" => $row["gallery"],
        "category" => $row["category"],
        "description" => $row["description"],
        "rating" => $row["rating"],
     );
    $i++;
}
