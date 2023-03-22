<?php

// Файлы необходимые для соединения с БД
include_once('./classes/Database.php');

class GetData {

    public $database;
    public $conn;

    public $query;

    public function __construct($a) {
        $this->query = $a;
        
        $this->database = new Database();
        $this->conn = $this->database->getConnection();
    }
    public function execute_query() {
        $result = $this->conn->query($this->query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $resultArr = [];
        foreach($result as $row){
            $resultArr[] = $row;
        }
        return json_encode($resultArr);
    }
}