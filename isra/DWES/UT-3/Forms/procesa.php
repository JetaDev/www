<?php
$default_texto = 'hola';
$texto = $_GET['nombre'] ?? $default_texto;
$cb = isset($_GET['checkbox']) ? 'Sí' : 'No';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Hola, has escrito <?= htmlspecialchars($texto)?></p>
    <p>Has marcado <?=$cb?></p>
</body>
</html>