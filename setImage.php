<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

function saveImage($image, $folder, $id){
    $request['request'] = array();
    $img = $_FILES['Image'];
    $name_folder = $_POST['Folder'] + '/';
    $id = $_POST['id'];

    if (!is_dir($name_folder)) {
        mkdir($name_folder, 0777, true);}

    $targetFile = $name_folder . ($id + basename($_FILES["Image"]["name"]));
    $uploadOk = true;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $item = array();

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check == false) {
        array_push($item, "El archivo no es una imagen.", false);
    }elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        array_push($item, "Solo se permiten archivos JPG. JPEG. PNG.", false);
    }elseif ($_FILES["image"]["size"] > 15000000){
        array_push($item, "EL archivo excede el peso permitido.", false);
    }elseif (file_exists($targetFile)){
        array_push($item, "EL archivo ya existe", false);
    }else {
            array_push($item, "EL archivo fue procesado con exito.", true);}
        
    if (!$item[1]) {
        $items = array(
            false,
            $item[0]);
        array_push($request['request'], $items);
        return json_encode($request);
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $items = array(
                true,
                realpath($targetFile));
            array_push($request['request'], $items);}}
    return json_encode($request);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request['request'] = array();
    if (isset($_FILES['Image']) && isset($_POST['Folder']) && isset($_POST['id'])) {
       $image = $_FILES['Image'];
       $folder = $_POST['Folder'];
       $id = $_POST['id'];

       echo saveImage($image, $folder, $id);
       
    }else {
    echo "No se envió ningún archivo.<br>";}
}else {
echo "Método no permitido.<br>";}
?>
