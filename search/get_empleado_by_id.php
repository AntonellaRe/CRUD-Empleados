<?php
require('../conn.php');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM empleado WHERE id = :id LIMIT 1";
$statement = $connect->prepare($query);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $data['status_code'] = 200;
    $data['empleado'] = $result;
    echo json_encode($data);
} else {
    $data['status_code'] = 404;
    $data['message'] = "empleado not found";
    echo json_encode($data);
}
?>