<?php

class Comment
{
    private $conn;
    public $table_name = 'comments';
    public $id_user;
    public $id_prod;
    public $description;
    public $rating;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addComment()
    {
        $query = "INSERT INTO " . $this->table_name . "
        SET
            id_user = :id_user,
            id_prod = :id_prod,
            description = :description,
            rating = :rating";

        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Инъекция (отчистка от всякого)
        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        $this->id_prod = htmlspecialchars(strip_tags($this->id_prod));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->rating = htmlspecialchars(strip_tags($this->rating));

        // Привязываем значения
        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->bindParam(":id_prod", $this->id_prod);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":rating", $this->rating);

        // Выполняем запрос
        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
        if ($stmt->execute()) {
            return true;
        }

    }

    public function getComment()
    {

    }

    public function deliteComment()
    {

    }
}