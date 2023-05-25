<?php

include_once('./classes/Database.php');

class DeleteData {
 
    public $database;
    public $conn;
    public $param;
    protected $q;
    // функция получающая параметры в $param
    public function __construct() {
        $this->q = $_GET['q'];
        $this->q = explode('/', $this->q);

        if(isset($this->q[1])){
            $this->param = $this->q[1];
        }
    }
    public function execute_query($query) {
        //подключение к бд
        $this->database = new Database();
        $this->conn = $this->database->getConnection();

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':param', $this->param);

        try {
            $stmt->execute();
            $affectedRowsNumber = $stmt->rowCount();
            echo "Удалено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            http_response_code(500);
        }
    }
}

?>