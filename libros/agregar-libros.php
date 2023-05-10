<?php

include('../conexion/conexion.php');

$titulo = $_POST['titulo'];
$autor_id = $_POST['autor_id'];
$anio = $_POST['anio'];
$especialidad = $_POST['especialidad'];
$editorial = $_POST['editorial'];
$urls = $_POST['urls'];

$conexion = conectar();

$query = $conexion->prepare('INSERT INTO libro (titulo,  autor_id, anio, especialidad, editorial, urls) VALUE (?, ?, ?, ?, ?, ?)');
$query->bind_param('ssssss', $titulo,$autor_id,  $anio, $especialidad, $editorial, $urls);
$msg = '';
if ($query->execute()) {
    $msg = 'Libro registrado con éxito';
}
else {
    $msg = 'No se pudo registrar al libro';
}

desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libro</title>
</head>
<body>
    <h1>Agregar Libro</h1>
    <h3><?php echo $msg ?></h3>
    <a href="libros.php">Regresar</a>
</body>
</html>