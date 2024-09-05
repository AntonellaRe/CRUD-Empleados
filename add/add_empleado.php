<?php
require('../conn.php');

$name = isset($_POST['name']) ? $_POST['name'] : '';
$active = isset($_POST['active']) ? intval($_POST['active']) : 0;
$avatar = '';

if (!empty($name) && isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = './uploads/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Validar si es una imagen
    $check = getimagesize($_FILES['avatar']['tmp_name']);
    if ($check !== false) {
        // Validar el tipo de archivo (jpg, png, jpeg, gif)
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Mover el archivo subido al directorio de destino
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                $avatar = $uploadFile;

                // Insertar en la base de datos
                $query = "INSERT INTO empleado (name, avatar, active) VALUES (:name, :avatar, :active)";
                $statement = $connect->prepare($query);
                $statement->bindParam(':name', $name, PDO::PARAM_STR);
                $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
                $statement->bindParam(':active', $active, PDO::PARAM_INT);
                

                if ($statement->execute()) {
                    $response = array('status_code' => 200, 'message' => 'Empleado added successfully', 'id' => $connect->lastInsertId());
                } else {
                    $response = array('status_code' => 500, 'message' => 'Failed to add Empleado');
                }
            } else {
                $response = array('status_code' => 500, 'message' => 'Failed to upload avatar');
            }
        } else {
            $response = array('status_code' => 400, 'message' => 'Only JPG, JPEG, PNG & GIF files are allowed');
        }
    } else {
        $response = array('status_code' => 400, 'message' => 'File is not an image');
    }
} else {
    $response = array('status_code' => 400, 'message' => 'Invalid input or file upload error');
}

echo json_encode($response);
?>
