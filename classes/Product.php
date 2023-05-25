<?php

class Product
{
    private $conn;
    private $table_name = "products";
    public $id_prod;
    public $rating;


    public $name;
    public $price;
    public $description;
    public $gallery;
    public $category;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function ratingChange()
    {
        // $result = $this->conn->query($query);
        // $result = $result->fetchAll(PDO::FETCH_ASSOC);
        // $resultArr = [];
        // foreach($result as $row){
        //     $resultArr[] = $row;
        // }



        $query = "SELECT rating
        FROM " . 'comments' . "
        WHERE id_prod = :id_prod";

        $stmt = $this->conn->prepare($query);

        $this->id_prod = htmlspecialchars(strip_tags($this->id_prod));

        // Привязываем значение id_prod
        $stmt->bindParam(':id_prod', $this->id_prod);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resultArr = [];

        foreach ($result as $row) {
            // echo $row['rating'];
            $resultArr[] = $row['rating'];
        }

        $sum = 0;

        foreach ($resultArr as $number) {
            $sum += $number;
        }

        $count = count($resultArr); // Количество чисел в массиве
        $average = $sum / $count;

        $average = round($average, 1);
        
        $query = "UPDATE products SET rating = " . $average . " WHERE id =" . $this->id_prod;

        

        $this->conn->exec($query);

    }

    public function newproduct()
    {



        $query = "INSERT INTO " . $this->table_name . "
                    SET
                        name = :name,
                        price = :price,
                        description = :description,
                        category = :category,
                        gallery = :gallery";


        $stmt = $this->conn->prepare($query);

        // Инъекция (отчистка от всякого)
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        // $this->gallery = htmlspecialchars(strip_tags($this->gallery));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Привязываем значения
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":gallery", $this->gallery);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category", $this->category);

        // Выполняем запрос
        // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
        if ($stmt->execute()) {
            echo 1;
        }
    }
}

?>