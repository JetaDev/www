<?php

// MATRIZ BIDIMENSIONAL ASOCIATIVA
$distancias = array(
    "Barcelona" => array(
        "Barcelona" => 0,
        "Coruña"    => 1188,
        "Madrid"    => 621,
        "Sevilla"   => 1046
    ),
    "Coruña" => array(
        "Barcelona" => 1188,
        "Coruña"    => 0,
        "Madrid"    => 609,
        "Sevilla"   => 947
    ),
    "Madrid" => array(
        "Barcelona" => 621,
        "Coruña"    => 609,
        "Madrid"    => 0,
        "Sevilla"   => 538
    ),
    "Sevilla" => array(
        "Barcelona" => 1046,
        "Coruña"    => 947,
        "Madrid"    => 538,
        "Sevilla"   => 0
    )
);

// Obtener claves seleccionadas
$origen = $_GET['origen'];
$destino = $_GET['destino'];

// Obtener distancia
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
    La distancia entre <strong><?php echo $origen; ?></strong> 
    y <strong><?php echo $destino; ?></strong> es de:
</p>

<h2><?php echo $distancia; ?> km</h2>

</body>
</html>
