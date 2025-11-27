<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>
</head>

<body>

<?php
// Unidades recibidas del formulario
$articulo1 = $_GET['articulo1'] ?? 0;
$articulo2 = $_GET['articulo2'] ?? 0;
$articulo3 = $_GET['articulo3'] ?? 0;

// Precios unitarios
$precio1 = 5.99;
$precio2 = 12.49;
$precio3 = 19.99;

// Subtotales
$sub1 = $articulo1 * $precio1;
$sub2 = $articulo2 * $precio2;
$sub3 = $articulo3 * $precio3;

// Total sin IVA ni descuento
$total = $sub1 + $sub2 + $sub3;

// ------------------------------
// CALCULAR DESCUENTO SEGÚN TOTAL DE UNIDADES
// ------------------------------

$totalUnidades = $articulo1 + $articulo2 + $articulo3;

if ($totalUnidades < 5) {
    $porcentajeDescuento = 0;
} elseif ($totalUnidades <= 10) {
    $porcentajeDescuento = 5;
} elseif ($totalUnidades <= 20) {
    $porcentajeDescuento = 10;
} else {
    $porcentajeDescuento = 25;
}

// Valor del descuento en euros
$descuentoEuro = $total * ($porcentajeDescuento / 100);

// Total tras aplicar el descuento
$totalConDescuento = $total - $descuentoEuro;

// IVA 20%
$iva = $totalConDescuento * 0.20;

// Total final con IVA
$totalFinal = $totalConDescuento + $iva;

// Fecha
$fecha = date("d/m/Y");
?>

<h1>Factura</h1>
<p><strong>Fecha:</strong> <?= $fecha ?></p>

<table border="1">
    <tr>
        <th>Artículo</th>
        <th>Precio unitario</th>
        <th>Unidades</th>
        <th>Subtotal</th>
    </tr>

    <tr>
        <td>Artículo 1</td>
        <td>€<?= $precio1 ?></td>
        <td><?= $articulo1 ?></td>
        <td>€<?= number_format($sub1, 2) ?></td>
    </tr>

    <tr>
        <td>Artículo 2</td>
        <td>€<?= $precio2 ?></td>
        <td><?= $articulo2 ?></td>
        <td>€<?= number_format($sub2, 2) ?></td>
    </tr>

    <tr>
        <td>Artículo 3</td>
        <td>€<?= $precio3 ?></td>
        <td><?= $articulo3 ?></td>
        <td>€<?= number_format($sub3, 2) ?></td>
    </tr>
</table>

<br>

<table border="1">
    <tr>
        <th>Total unidades</th>
        <th>Descuento (%)</th>
        <th>Descuento (€)</th>
        <th>Total sin IVA</th>
        <th>IVA (20%)</th>
        <th>Total con IVA</th>
    </tr>
    <tr>
        <td><?= $totalUnidades ?></td>
        <td><?= $porcentajeDescuento ?>%</td>
        <td>€<?= number_format($descuentoEuro, 2) ?></td>
        <td>€<?= number_format($totalConDescuento, 2) ?></td>
        <td>€<?= number_format($iva, 2) ?></td>
        <td>€<?= number_format($totalFinal, 2) ?></td>
    </tr>
</table>

</body>
</html>
