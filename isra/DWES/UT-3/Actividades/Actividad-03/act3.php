<?php
$texto = $_GET['texto'] ?? '';
$tamanio = $_GET['tamanio'] ?? '1';
$color = $_GET['color'] ?? 'black';
$estilo = $_GET['estilo'] ?? 'solid';

$estilo_borde = "border: {$tamanio}px {$estilo} {$color}; padding: 10px; margin-top: 20px;";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h2>Texto con Formato</h2>
    <div style="<?= $estilo_borde ?>"><?= $texto ?></div>
</body>
</html>
