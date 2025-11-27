<?php

$cantidad = $_GET['cantidad'];
$funcion  = $_GET['funcion'];

// Crear array para guardar los valores
$valores = array();

// Rellenarlo usando variables variables
for ($i = 1; $i <= $cantidad; $i++) {
    $campo = "valor$i";
    $valores[] = $_GET[$campo];
}

// Calcular función
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
