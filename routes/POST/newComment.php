<?php



// Файлы необходимые для соединения с БД
include_once "./classes/Database.php";
include_once "./classes/Comment.php";
include_once "./classes/Product.php";

// Получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();


$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->id_prod = $data->id_prod;

$product->ratingChange();


$comment = new Comment($db);

// Получаем данные

$comment->id_user = $data->id_user;
$comment->id_prod = $data->id_prod;
$comment->description = $data->description;
$comment->rating = $data->rating;

if ($comment->addComment()) {



    echo json_encode(
        array(
            'id_user' => $comment->id_user,
            "id_prod" => $comment->id_prod,
            "description" => $comment->description,
            "rating"=> $comment->rating,
        )
    );
} else {
    http_response_code(400);
}