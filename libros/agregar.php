<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libros.css">
    <title>Agregar Libro</title>
</head>

<body>
    <div class="contenedor">
        <h1>Agregar Libro</h1>
        <form name="formulario" method="post" action="agregar-libros.php">
            <table>
                <tbody>
                    <tr>
                        <td>Titulo del libro</td>
                        <td>
                        <input type="text" name="titulo" maxlength="150" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="autor_id">Seleccione un autor:</label>
                            <td>
                            <select name="autor_id" id="autor_id" class="form-select">
                            <?php
                            include('../conexion/conexion.php');
                        
                            $conexion = conectar();
                        
                            $query_autor = "SELECT autor_id, CONCAT (autor_id, ' | ',nombres, ' ', ape_paterno) AS nombre_autor FROM autor";
                            $result_autor = mysqli_query($conexion, $query_autor);
                            while($row_autor = mysqli_fetch_array($result_autor)) {
                                echo '<option value="' .$row_autor['autor_id'] . '">' . $row_autor['nombre_autor'] . '</option>';}
                                desconectar($conexion);
                                ?>
                                </td>
                        </select>
                        </td>
                    </tr> 
                    <tr>
                        <td>Año</td>
                        <td>
                            <input type="number" name="anio" maxlength="11" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Especialidad</td>
                        <td>
                            <input type="text" name="especialidad" maxlength="60" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Editorial</td>
                        <td>
                            <input type="text" name="editorial" maxlength="60" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Url</td>
                        <td>
                            <input type="text" name="urls" maxlength="250" required>
                        </td>
                    </tr>
                    <td colspan="2">
                        <button type="submit" class="boton--agregar">Guardar</button>
                        <br>
                        <br>
                        <a href="libros.php">Regresar</a>
                    </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>