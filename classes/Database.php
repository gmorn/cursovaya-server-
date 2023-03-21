<?php

class Database
{
    // Учётные данные базы данных
    private $host = "localhost";
    private $db_name = "cyrsovaya";
    private $username = "root";
    private $password = "";
    public $conn;

    // Получаем соединение с базой данных
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Ошибка соединения с БД: " . $exception->getMessage();
        }

        return $this->conn;
    }
}