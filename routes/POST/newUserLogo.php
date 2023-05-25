<?php

    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: POST'); 
    // header('Access-Control-Allow-Headers: Content-Type'); 

    include_once "./classes/Database.php";
    include_once "./classes/User.php";


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $uploadedFile = $_FILES["file"];
      
        // Проверяем наличие ошибок при загрузке файла
        if ($uploadedFile["error"] === UPLOAD_ERR_OK) {
            $tempPath = $uploadedFile["tmp_name"];
            
            // $filename = $_FILES['name'];

            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            $randomName = uniqid().'.'.$extension;

            $destinationPath = "images/user/" . $randomName;

            $path = 'http://cursovaya/'. $destinationPath;

            // Перемещаем загруженный файл в целевую директорию
            if (move_uploaded_file($tempPath, $destinationPath)) {

                $database = new Database();
                $db = $database->getConnection();

                // Создание объекта "User"
                $user = new User($db);

                $q = $_GET['q'];
                $q = explode('/', $q);
        
                if(isset($q[1])){
                    $param = $q[1];
                }


                $user->newUserLogo($param, $path);


                echo "$path";


            } else {
                echo "Ошибка при перемещении файла.";
            }
        } else {
            echo "Ошибка при загрузке файла: " . $uploadedFile["error"];
        }


    }


?>