<?php

include('../conexion/conexion.php');


$libro_id = $_GET['libro_id'];


$conexion = conectar();


$query = $conexion->prepare('DELETE FROM libro WHERE libro_id = ?');
$query->bind_param('i', $libro_id);
$query->execute();

$query = $conexion->prepare('ALTER TABLE libro AUTO_INCREMENT = 1');
$query->execute();


desconectar($conexion);


header('Location: libros.php');
exit;
