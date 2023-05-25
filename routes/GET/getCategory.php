<?php
include_once('./classes/GetData.php');
$data = new GetData();
echo $data->execute_query("SELECT * FROM `category`");