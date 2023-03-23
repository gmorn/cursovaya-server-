<?php

// Файлы необходимые для соединения с БД
include_once('./classes/Database.php');

class GetData {

    public $database;
    public $conn;
    public $param;
    protected $q;

    

    public function __construct() {
        $this->q = $_GET['q'];
        $this->q = explode('/', $this->q);
        
        if(isset($this->q[1])){
            $this->param = $this->q[1];
        }
    }
    public function execute_query($query) {
        $this->database = new Database();
        $this->conn = $this->database->getConnection();

        $result = $this->conn->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $resultArr = [];
        foreach($result as $row){
            $resultArr[] = $row;
        }
        return json_encode($resultArr);
    }
}