<?php

include_once "./classes/Database.php";
include_once "./classes/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);


// echo $_FILES['gallery'];

$galleryFiles = $_FILES['gallery'];
// echo $_POST['price'];

$gallery = [];

foreach ($galleryFiles['tmp_name'] as $key => $tmpName) {

    
    $fileName = $galleryFiles['name'][$key];
    $fileSize = $galleryFiles['size'][$key];
    $fileType = $galleryFiles['type'][$key];
    $fileError = $galleryFiles['error'][$key];
    
    // Генерация случайного имени файла
    $randomName = uniqid() . '_' . $fileName;
    
    // Путь для сохранения файла
    $destination = 'images/products/' . $randomName;

    $path = 'http://cursovaya/'. $destination;
    
    $gallery[] = $path;

    // Перемещение файла на сервер
    if (move_uploaded_file($tmpName, $destination)) {
        // Файл успешно сохранен
    } else {
        echo 2;
        
        // Ошибка сохранения файла
    }
    // Дальней
}
// echo $gallery[1].;

$string = $gallery[0].",".$gallery[1].",".$gallery[2];

echo $string;
// Разбиваем строку по запятой и пробелу
$urls = explode(',', $string);

$newString = "[";

foreach ($urls as $url) {
  // Удаляем экранирование из слешей
  $url = str_replace('\/', '/', $url);
  
  // Добавляем кавычки в начало и конец каждой строки
  $url = '"' . $url . '"';
  
  // Добавляем запятую после каждой строки, кроме последней
  if ($url !== end($urls)) {
    $url .= ',';
  }
  
  $newString .= $url;
}

$newString .= "]";

// echo $newString;

$product->name = $_POST['name'];
$product->price = $_POST['price'];
$product->description = $_POST['description'];
$product->category = $_POST['category'];
$product->gallery = $newString;


$product->newproduct()

?>