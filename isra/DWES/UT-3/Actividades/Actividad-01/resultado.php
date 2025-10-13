<?php
$num1 = $_POST['num1'] ?? 0;
$num2 = $_POST['num2'] ?? 0;
$operacion = $_POST['operacion'] ?? '';

switch ($operacion) {
    case 'suma':
        $resultado = $num1 + $num2;
        $operacion = '+';

        break;
    case 'resta':
        $resultado = $num1 - $num2;
        $operacion = '-';

        break;
    case 'multiplicacion':
        $resultado = $num1 * $num2;
        $operacion = '*';
        break;
    case 'division':
        $resultado = $num2 != 0 ? $num1 / $num2 : 'Error: división por cero';
        $operacion = '/';

        break;
    case 'modulo':
        $resultado = $num2 != 0 ? $num1 % $num2 : 'Error: módulo por cero';
        $operacion = '%';

        break;
    default:
        $resultado = 'Operación no válida';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h2>Resultado de la operación</h2>
    <p>  <?= $num1 ?> <?= $operacion ?> <?= $num2 ?> = <?= $resultado ?></strong></p>
</body>
</html>
 