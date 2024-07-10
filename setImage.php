<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['Image']) && isset($_POST['Folder']) && isset($_POST['id'])) {
        $img = $_FILES['Image'];
        $name_folder = $_POST['Folder'] + '/';
        $id = $_POST['id'];

        if (!is_dir($name_folder)) {
            mkdir($name_folder, 0777, true);}

        $targetFile = $name_folder . ($id + basename($_FILES["Image"]["name"]));
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check == false) {
            echo "El archivo no es una imagen.<br>";
            $uploadOk = false;
            }elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG.<br>";
                $uploadOk = false;
            }elseif ($_FILES["image"]["size"] > 15000000){
                echo "Lo siento, el archivo es demasiado grande.<br>";
                $uploadOk = false;
            }elseif (file_exists($targetFile)){
                echo "Lo siento, el archivo ya existe.<br>";
                $uploadOk = false;
            }else {
            echo "Procesado con exito.<br>";
            $uploadOk = true;}


        if (!$uploadOk) {
            echo "Lo siento, tu archivo no fue subido.<br>";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "El archivo " . basename($_FILES["image"]["name"]) . " ha sido subido.<br>";
                echo "La ruta completa del archivo es: " . realpath($targetFile) . "<br>";
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.<br>";
            }
        }

    } else {
        echo "No se envió ningún archivo.<br>";
    }
} else {
    echo "Método no permitido.<br>";
}
?>
