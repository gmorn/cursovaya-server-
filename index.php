<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json");


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
            'token' => 'validate_token.php'
        ],
        'GET' => [
            'getProd' => 'getProd.php',
            'comments' => 'getComments.php',
        ],
    ]
];

if(isset($routes['methods'][$method][$formData])) {
    require_once ('routes/'.$routes['methods'][$method].'/'.$routes['methods'][$method][$formData]);
} else {
    echo 'Несуществующий путь';
}