<?php
include_once('./classes/GetData.php');

$q = $_GET['q'];
$params = explode('/', $q);

$id_prod = $params[1];

$data = new GetData("SELECT * FROM `comments` WHERE id_prod = $id_prod");

echo $data->execute_query();