<?php
include_once('./classes/GetData.php');
$data = new GetData();
$count = $data->execute_query("SELECT * FROM `comments` WHERE id_user = $data->param");

if ( $count !== 0 ) {
    echo $count;
}