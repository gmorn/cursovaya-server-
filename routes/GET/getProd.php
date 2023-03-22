<?php
include_once('./classes/GetData.php');

$data = new GetData("SELECT * FROM `products`");

echo $data->execute_query();