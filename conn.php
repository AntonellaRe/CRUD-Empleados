<?php
$dsn = 'mysql:dbname=empleados;host=localhost';
$usuario = 'root';
$contraseña = '';

try {
    $connect = new PDO($dsn, $usuario, $contraseña);
    //echo 'conectado';
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

?>