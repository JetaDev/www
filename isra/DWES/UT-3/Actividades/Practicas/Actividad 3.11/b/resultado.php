<?php

$cantidad = $_GET['cantidad'];
$funcion  = $_GET['funcion'];

// Aquí llega ya una MATRIZ (array)
$valores = $_GET['valores'];   

// Realizar el cálculo según la función elegida
switch ($funcion) {

    case "min":
        $resultado = min($valores);
        break;

    case "max":
        $resultado = max($valores);
        break;

    case "suma":
        $resultado = array_sum($valores);
        break;

    case "media":
        $resultado = array_sum($valores) / count($valores);
        break;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<p><strong>Valores introducidos:</strong></p>
<pre><?php print_r($valores); ?></pre>

<p><strong>Operación:</strong> <?php echo $funcion; ?></p>

<h2>Resultado final: <?php echo $resultado; ?></h2>

</body>
</html>
