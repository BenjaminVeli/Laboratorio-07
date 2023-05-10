<?php

include('../conexion/conexion.php');

$conexion = conectar();

$libro_id = $_GET['libro_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $especialidad = $_POST['especialidad'];
    $editorial = $_POST['editorial'];
    $urls = $_POST['urls'];
    

    $query = $conexion->prepare('UPDATE libro SET titulo=?,  anio=? , especialidad=?, editorial=?, urls=? WHERE libro_id=?');
    $query->bind_param('sssssi', $titulo, $anio, $especialidad, $editorial, $urls, $libro_id );
    $query->execute();
    
    header('Location: libros.php');
    exit();
}

else {
    
    $query = $conexion->prepare('SELECT titulo, anio, especialidad, editorial, urls FROM libro WHERE libro_id=?');
    $query->bind_param('i', $libro_id);
    $query->execute();
    $resultado = $query->get_result();
    $libro = $resultado->fetch_array();
    
    if (!$libro) {
        header('Location: libros.php');
        exit();
    }
}

desconectar($conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libros.css">
    <title>Editar libro</title>
</head>
<body>
    <div class="contenedor">
    <h1>Editar libro</h1>
    <form method="post">
    <table>
            <tbody>
            <input type="hidden" name="autor_id" value="<?php echo $autor_id; ?>">
            <tr>
                <td>Titulo del libro</td>
                <td>
                <input type="text" name="titulo" value="<?php echo $libro['titulo']; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Año</td>
                <td>
                <input type="text" name="anio" value="<?php echo $libro['anio']; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Especialidad</td>
                <td>
                <input type="text" name="especialidad" value="<?php echo $libro['especialidad']; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Editorial</td>
                <td>
                <input type="text" name="editorial" value="<?php echo $libro['editorial']; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Url</td>
                <td>
                <input type="text" name="urls" value="<?php echo $libro['urls']; ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                     <button type="submit" class="boton--agregar">Guardar</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    </div>
</body>
</html>