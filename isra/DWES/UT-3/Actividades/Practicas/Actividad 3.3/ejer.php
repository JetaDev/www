<?php
// Recogemos los valores enviados mediante GET
$texto = $_GET['texto'];
$tamaño = $_GET['tamaño'];
$estilo = $_GET['estilo'];
$color = $_GET['color'];

if ($estilo == "liso") {
    $borderStyle = "solid";
} elseif ($estilo == "doble") {
    $borderStyle = "double";
} elseif ($estilo == "punteado") {
    $borderStyle = "dotted";
} elseif ($estilo == "oculto") {
    $borderStyle = "hidden";
} else {
    $borderStyle = "solid";
}

if ($color == "negro") {
    $borderColor = "black";
} elseif ($color == "rojo") {
    $borderColor = "red";
} elseif ($color == "azul") {
    $borderColor = "blue";
} elseif ($color == "amarillo") {
    $borderColor = "yellow";
} else {
    $borderColor = "black";
}

$borderWidth = $tamaño . "px";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Texto con borde</title>

    <style>
      .cuadro {
        border-style: <?php echo $borderStyle; ?>;
        border-width: <?php echo $borderWidth; ?>;
        border-color: <?php echo $borderColor; ?>;
        padding: 10px;
        display: inline-block;
        margin-top: 20px;
      }
    </style>
</head>
<body>
    <div class="cuadro">
        <?php echo htmlspecialchars($texto); ?>
    </div>
</body>
</html>
