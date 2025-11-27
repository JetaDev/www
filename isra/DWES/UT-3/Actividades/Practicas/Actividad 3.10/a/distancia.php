<?php

$distancias = array(
    array(0,   1188, 621, 1046),  // Barcelona
    array(1188, 0,   609, 947),   // Coruña
    array(621, 609, 0,   538),    // Madrid
    array(1046, 947, 538, 0)      // Sevilla
);

$ciudades = array("Barcelona", "Coruña", "Madrid", "Sevilla");

// Obtener índices seleccionados
$origen = $_GET['origen'];
$destino = $_GET['destino'];

// Obtener distancia de la matriz
$distancia = $distancias[$origen][$destino];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<p>
    La distancia entre <strong><?php echo $ciudades[$origen]; ?></strong> 
    y <strong><?php echo $ciudades[$destino]; ?></strong> es de:
</p>

<h2><?php echo $distancia; ?> km</h2>

</body>
</html>
