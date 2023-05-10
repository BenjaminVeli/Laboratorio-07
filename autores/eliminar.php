<?php

include('../conexion/conexion.php');


$autor_id = $_GET['autor_id'];


$conexion = conectar();


$query = $conexion->prepare('DELETE FROM autor WHERE autor_id = ?');
$query->bind_param('i', $autor_id);
$query->execute();

$query = $conexion->prepare('ALTER TABLE autor AUTO_INCREMENT = 1');
$query->execute();


desconectar($conexion);


header('Location: autores.php');
exit;
