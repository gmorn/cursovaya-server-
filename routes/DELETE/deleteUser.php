<?php
include_once('./classes/DeleteData.php');
$data = new DeleteData();
$data->execute_query("DELETE FROM users WHERE id = :param");