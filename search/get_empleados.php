<?php
require('../conn.php');
$query = "SELECT * FROM empleado";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if ($result) {
    $data['data']['status_code'] = 200;
    
    foreach ($result as $row) {
        $data['data']['empleados'][] = array(
            'id'   => $row["id"],
            'name'   => $row["name"],
            'avatar'   => "./add/".$row["avatar"],
            'active' => $row["active"]
        );
    }
    
    echo json_encode($data);
} else {
    $data = array(
        'status' => 401
    );
    echo json_encode($data);
}
?>
