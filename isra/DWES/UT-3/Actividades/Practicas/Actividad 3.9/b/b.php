<?php
    $nombre=$_GET['nombre'] ?? '';
    $apellido=$_GET['apellido'] ?? '';
    $curso =$_GET['curso'] ?? '';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>DATOS DE CLASE</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Curso</th>
        </tr>
        <tr>
            <td><?php $nombre ?></td>
            <td><?php $apellido ?></td>
            <td><?php $curso ?></td>
        </tr>
    </table>
</body>
</html>