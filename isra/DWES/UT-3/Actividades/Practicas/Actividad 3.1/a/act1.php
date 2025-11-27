<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos recibidos</title>
</head>
<body>
    <h2>Datos introducidos</h2>
    <?php
    $nombre = $_GET['nombre'] ?? '';
    $apellidos = $_GET['apellidos'] ?? '';
    $direccion = $_GET['direccion'] ?? '';
    $telefono =$_GET['telefono'] ?? '';

    ?>
    <table border= "1">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Dirrecion</th>
            <th>Telefono</th>
        </tr>
        <tr>
            <td><?= $nombre ?></td>
            <td><?= $apellidos ?></td>
            <td><?= $direccion ?></td>
            <td><?= $telefono ?></td>     
        </tr>
    </table>
</body>
</html>
