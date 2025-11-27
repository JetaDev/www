<?php
// Recoger datos
$nombre = $_GET['nombre'];
$apuesta = $_GET['apuesta'];

// Generar tirada de los dados
$dado1 = rand(1,6);
$dado2 = rand(1,6);

$suma = $dado1 + $dado2;

// Comprobar ganador
if ($suma == $apuesta) {
    $mensaje = "¡Enhorabuena $nombre, has ganado!";
} else {
    $mensaje = "Lo siento $nombre, gana la banca.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>

    <style>
        img {
            width: 120px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h1>Resultado de la tirada</h1>

<p><strong>Jugador:</strong> <?php echo $nombre; ?></p>
<p><strong>Apuesta:</strong> <?php echo $apuesta; ?></p>

<h2>Dados lanzados:</h2>

<!-- Imágenes de los dados -->
<img src="img/<?php echo $dado1; ?>.png">
<img src="img/<?php echo $dado2; ?>.png">

<p><strong>Suma obtenida:</strong> <?php echo $suma; ?></p>

<h2><?php echo $mensaje; ?></h2>

</body>
</html>
