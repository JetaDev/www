<?php
$datos = array(
    "Nombre" => $_GET['nombre'],
    "Apellidos" => $_GET['apellidos'],
    "Teléfono" => $_GET['telefono'],
    "Dirección" => $_GET['direccion'],
    "Población" => $_GET['poblacion'],
    "Provincia" => $_GET['provincia'],
    "Fecha de nacimiento" => $_GET['fecha'],
    "Estudios" => $_GET['estudios']
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos recibidos</title>
</head>
<body>

<h1>Datos del alumno</h1>

<table border="1">
    <tr>
        <?php
        // ENCABEZADOS
        foreach ($datos as $clave => $valor) {
            echo "<th>$clave</th>";
        }
        ?>
    </tr>

    <tr>
        <?php
        // VALORES
        foreach ($datos as $valor) {
            echo "<td>$valor</td>";
        }
        ?>
    </tr>
</table>

</body>
</html>
