<?php
// Precios unitarios
$precio1 = 5.99;
$precio2 = 12.49;
$precio3 = 19.99;
$iva = 0.20;

//Descuentos
$desc1 = 0.05;
$desc2 = 0.10;
$desc3 = 0.25;
$desc = 0;
$porc_desc = '0';

// Unidades solicitadas
$u1 = $_GET['articulo1'] ?? 0;
$u2 = $_GET['articulo2'] ?? 0;
$u3 = $_GET['articulo3'] ?? 0;

// Subtotales
$sub1 = $u1 * $precio1;
$sub2 = $u2 * $precio2;
$sub3 = $u3 * $precio3;

// Total sin IVA
$total_sin_iva = $sub1 + $sub2 + $sub3;

//Descuento
$u_totales = $u1 + $u2 + $u3;
if ($u_totales < 5 ) {
    $porc_desc = '0';
}else if ($u_totales >= 5 && $u_totales <=10) {
    $desc = $total_sin_iva * $desc1 ;
    $total_sin_iva -= $desc;
    $porc_desc = '5%';
}else if ($u_totales < 20 ) {
    $desc = $total_sin_iva * $desc2 ;
    $total_sin_iva -= $desc;
    $porc_desc = '10%';
}else if($u_totales >= 20 ) {
    $desc = $total_sin_iva * $desc3 ;
    $total_sin_iva -= $desc;
    $porc_desc = '25%';
}
// IVA y total final
$importe_iva = $total_sin_iva * $iva;
$total_con_iva = $total_sin_iva + $importe_iva;



$fecha = date("d/m/Y");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
</head>
<body>
    <h2>Factura de Pedido</h2>
    <p>Fecha de emisión: <?= $fecha ?></p>
    <table border="1" cellpadding="8">
        <tr>
            <th>Artículo</th>
            <th>Unidades</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
        <tr>
            <td>Artículo A</td>
            <td><?= $u1 ?></td>
            <td>5.99€</td>
            <td><?= $sub1?>€</td>
        </tr>
        <tr>
            <td>Artículo B</td>
            <td><?= $u2 ?></td>
            <td>12.49€</td>
            <td><?= $sub2?>€</td>
        </tr>
        <tr>
            <td>Artículo C</td>
            <td><?= $u3 ?></td>
            <td>19.99€</td>
            <td><?= $sub3?>€</td>
        </tr>
        <tr>
            <th colspan="3">Descuento (<?=$porc_desc?>)</th>
            <td><?= round($desc, 2)?>€</td>
        </tr>
        <tr>
            <th colspan="3">IVA (20%)</th>
            <td><?=round($importe_iva,2)?>€</td>
        </tr>
        <tr>
            <th colspan="3">Total</th>
            <td><strong><?= round($total_con_iva,2)?>€</strong></td>
        </tr>
    </table>
</body>
</html>
