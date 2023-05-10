<?php

include('../conexion/conexion.php');

$conexion = conectar();

$autor_id = $_GET['autor_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombres = $_POST['nombres'];
    $ape_paterno = $_POST['ape_paterno'];
    $ape_materno = $_POST['ape_materno'];
    

    $query = $conexion->prepare('UPDATE autor SET nombres=?, ape_paterno=?, ape_materno=? WHERE autor_id=?');
    $query->bind_param('sssi', $nombres, $ape_paterno, $ape_materno, $autor_id);
    $query->execute();
    
    header('Location: autores.php');
    exit();
}

else {
    
    $query = $conexion->prepare('SELECT autor_id, nombres, ape_paterno, ape_materno FROM autor WHERE autor_id=?');
    $query->bind_param('i', $autor_id);
    $query->execute();
    $resultado = $query->get_result();
    $autor = $resultado->fetch_array();
    
    if (!$autor) {
        header('Location: autores.php');
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
    <link rel="stylesheet" href="autores.css">
    <title>Editar autor</title>
</head>
<body>
    <div class="contenedor">
    <h1>Editar autor</h1>
    <form method="post">
    <table>
            <tbody>
            <input type="hidden" name="autor_id" value="<?php echo $autor_id; ?>">
                <tr>
                    <td>Nombres:</td>
                    <td>
                    <input type="text" name="nombres" value="<?php echo $autor['nombres']; ?>" required>
                    </td>
                 </tr>
                <tr>
                    <td>Apellido Paterno:</td>
                     <td>
                     <input type="text" name="ape_paterno" value="<?php echo $autor['ape_paterno']; ?>" required>
                    </td>
                    </tr>
                <tr>
                    <td>Apellido Materno:</td>
                    <td>
                    <input type="text" name="ape_materno" value="<?php echo $autor['ape_materno']; ?>" required>
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


