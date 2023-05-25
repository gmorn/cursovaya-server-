<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: *");


$method = $_SERVER['REQUEST_METHOD'];

$formData = getFormData();



function getFormData() {

    $q = $_GET['q'];
    $params = explode('/', $q);
    $path = $params[0];

    return $path;
}


$routes = [
    'methods' => [
        'POST' => [
            'login' => 'login.php',
            'reg' => 'reg.php',
            'token' => 'validate_token.php',
            'newcomment' => 'newComment.php',
            'addHistory' => 'addHistory.php',
            'newUserLogo' => 'newUserLogo.php',
            'newProduct' => 'newProduct.php',
        ],
        'GET' => [
            'adresses' => 'getAdresses.php',
            'getprod' => 'getProd.php',
            'comments' => 'getComments.php',
            'history' => 'getHistory.php',
            'user' => 'getUser.php',
            'userComments' => 'getUserComments.php',
            'users' => 'getUsers.php',
            'category' => 'getCategory.php',
            'product' => 'getProduct.php',
        ],
        'DELETE' => [
            'user' => 'deleteUser.php',
            'comment' => 'deleteComment.php',
        ],
    ]
];

if(isset($routes['methods'][$method][$formData])) {
    include_once ('routes/'.$method.'/'.$routes['methods'][$method][$formData]);
} else {
    echo 'Несуществующий путь';
}