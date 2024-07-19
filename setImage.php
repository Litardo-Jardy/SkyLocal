<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    exit;
}

function saveImage($image, $folder, $id){
    $request['request'] = array();
    $name_folder = $folder . '/';
    $id = $id;

    if (!is_dir($name_folder)) {
        mkdir($name_folder, 0777, true);
    }

    $targetFile = $name_folder . ($id . basename($image["name"]));
    $uploadOk = true;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $item = array();

    $check = getimagesize($image["tmp_name"]);
    if ($check == false) {
        array_push($item, "El archivo no es una imagen.", false);
    } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($item, "Solo se permiten archivos JPG, JPEG, PNG.", false);
    } elseif ($image["size"] > 15000000) {
        array_push($item, "El archivo excede el peso permitido.", false);
    } elseif (file_exists($targetFile)) {
        array_push($item, "El archivo ya existe", false);
    } else {
        array_push($item, "El archivo fue procesado con éxito.", true);
    }
        
    if (!$item[1]) {
        $items = array(
            false,
            $item[0]
        );
        array_push($request['request'], $items);
        return json_encode($request);
    } else {
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            $items = array(
                true,
                'http://localhost/SkyLocal/' .  $folder . $id . $image["name"]
            );
            array_push($request['request'], $items);
        }
    }
    return json_encode($request);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['Image']) && isset($_POST['Folder']) && isset($_POST['id'])) {
       $image = $_FILES['Image'];
       $folder = $_POST['Folder'];
       $id = $_POST['id'];

       echo saveImage($image, $folder, $id);
       
    } else {
        echo json_encode(array("request" => array(array(false, "No se envió ningún archivo."))));
    }
} else {
    echo json_encode(array("request" => array(array(false, "Método no permitido."))));
}
?>

