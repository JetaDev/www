<?php
$nombre = $_GET['nombre'] ?? '';
$apellidos = $_GET['apellidos'] ?? '';
$direccion = $_GET['direccion'] ?? '';
$telefono = $_GET['telefono'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos Recibidos</title>
</head>
<body>
    <h2>Datos del Usuario</h2>
    <table border="1">
        <tr><th>Nombre</th><td><?= $nombre ?></td></tr>
        <tr><th>Apellidos</th><td><?= $apellidos ?></td></tr>
        <tr><th>Dirección</th><td><?= $direccion ?></td></tr>
        <tr><th>Teléfono</th><td><?= $telefono ?></td></tr>
    </table>
</body>
</html>
