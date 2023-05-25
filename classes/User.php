<?php

class User
{
    // Подключение к БД таблице "users"
    private $conn;
    private $table_name = "users";
    // Свойства
    public $id;
    public $name;
    public $password;
    public $userLogo;
    public $role;

    // Конструктор класса User
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Метод для создания нового пользователя
    public function create()
    {
        $query = "SELECT id, name, password, userlogo, role
        FROM " . $this->table_name . "
        WHERE name = ?
        LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        // Инъекция
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // Привязываем значение name
        $stmt->bindParam(1, $this->name);
    
        // Выполняем запрос
        $stmt->execute();
    
        // Получаем количество строк
        $num = $stmt->rowCount();
    
        // Если имя пользователя существует,
        // Присвоим значения свойствам объекта для легкого доступа и использования для php сессий
        if ($num === 0) {
        // Запрос для добавления нового пользователя в БД
            $query = "INSERT INTO " . $this->table_name . "
                    SET
                        name = :name,
                        password = :password";

            // Подготовка запроса
            $stmt = $this->conn->prepare($query);

            // Инъекция (отчистка от всякого)
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->password = htmlspecialchars(strip_tags($this->password));

            // Привязываем значения
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":password", $this->password);

            // Выполняем запрос
            // Если выполнение успешно, то информация о пользователе будет сохранена в базе данных
            if ($stmt->execute()) {
                return true;
            }
        }

        return false;
    }

    public function passworVerify($a, $b) {
        if ($a === $b) {
            return true;
        } else {
            return false;
        }
    }

// Проверка, существует ли имя пользователя в нашей базе данных
    public function nameExists() {
    
        // Запрос, чтобы проверить, существует ли имя пользователя
        $query = "SELECT id, name, password, userlogo, role
                FROM " . $this->table_name . "
                WHERE name = ?
                LIMIT 0,1";
    
        // Подготовка запроса
        $stmt = $this->conn->prepare($query);

        // Инъекция
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // Привязываем значение name
        $stmt->bindParam(1, $this->name);
    
        // Выполняем запрос
        $stmt->execute();
    
        // Получаем количество строк
        $num = $stmt->rowCount();
    
        // Если имя пользователя существует,
        // Присвоим значения свойствам объекта для легкого доступа и использования для php сессий
        if ($num > 0) {
    
            // Получаем значения
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Присвоим значения свойствам объекта
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            $this->userLogo = $row['userlogo'];
            $this->role = $row['role'];
    
            // Вернём "true", потому что в базе данных существует имя пользователя
            return true;
        }
    
        // Вернём "false", если имя пользователя не существует в базе данных
        return false;
    }

    public function newUserLogo($id, $path)
    {
        $query = "UPDATE users SET userlogo = '" . $path . "' WHERE id = " . $id;

$stmt = $this->conn->prepare($query);

// Выполняем запрос
if ($stmt->execute()) {
    // код обработки успешного выполнения запроса
}

    }
 
// Здесь будет метод update()
}