<?php
include_once('./classes/DeleteData.php');
$data = new DeleteData();
$data->execute_query("DELETE FROM comments WHERE id = :param");