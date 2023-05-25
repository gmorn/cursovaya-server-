<?php

class History 
{
    private $conn;
    private $table_name = "history";
    public $user_id;
    public $prods;
    public $date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        foreach ($this->prods as $prod) {
        $product_count = $prod->count;
        $product_id = $prod->id;
        echo $product_id;
            $query = "INSERT INTO " . $this->table_name . "
            SET
                user_id = :user_id,
                product_id = :product_id,
                date = :date,
                count = :count";
    
            $stmt = $this->conn->prepare($query);
    
            // Инъекция (отчистка от всякого)
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $product_id = htmlspecialchars(strip_tags($product_id));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $product_count = htmlspecialchars(strip_tags($product_count));
    
            // Привязываем значения
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":count", $product_count);
    
            // Выполняем запрос
            // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
            try {
                $stmt->execute();
                
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        return true;
    }
    public function delete()
    {
        
    }
}