<?php
$q = $_GET['q'];
$params = explode('/', $q);
$user_id = $params[1];

include_once('./classes/GetData.php');

$data = new GetData("SELECT * FROM `history` WHERE user_id = $user_id");

echo $data->execute_query();
