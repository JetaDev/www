<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>
</head>

<body>

    <?php
    $articulo1 = $_GET['articulo1'] ?? 0;
    $articulo2 = $_GET['articulo2'] ?? 0;
    $articulo3 = $_GET['articulo3'] ?? 0;

    $precio1 = 5.99;
    $precio2 = 12.49;
    $precio3 = 19.99;

    $sub1 = $articulo1 * $precio1;
    $sub2 = $articulo2 * $precio2;
    $sub3 = $articulo3 * $precio3;

    $total = $sub1 + $sub2 + $sub3;

    $iva = $total * 0.20;

    $totalFinal = $total + $iva;

    $fecha = date("d/m/Y");
    ?>

    <h1>Factura</h1>
    <p><strong>Fecha :</strong> <?= $fecha ?></p>

    <table border="1">
        <tr>
            <th>Artículo</th>
            <th>Precio Unitario</th>
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
            <th>Total sin IVA</th>
            <th>IVA (20%)</th>
            <th>Total con IVA</th>
        </tr>
        <tr>
            <td>€<?= number_format($total, 2) ?></td>
            <td>€<?= number_format($iva, 2) ?></td>
            <td>€<?= number_format($totalFinal, 2) ?></td>
        </tr>
    </table>

</body>

</html>