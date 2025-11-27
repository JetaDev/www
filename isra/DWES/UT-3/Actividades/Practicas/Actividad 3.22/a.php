<?php
// --- PRECIOS --- //
$tamanyos = ["mini" => 2.95, "media" => 4.95, "maxi" => 8.95];
$bases = ["normal" => 0, "crujiente" => 1, "rellena" => 2];

// Según enunciado:
// barbacoa = 0.95€
// carbonara = 1.45€
$salsas = ["ninguna" => 0, "barbacoa" => 0.95, "carbonara" => 1.45];

$ingredientes = [
    "pollo" => 0.55,
    "bacon" => 0.75,
    "jamón" => 0.95,
    "cebolla" => 0.45,
    "aceitunas" => 0.55,
    "pimiento" => 0.65
];

$phtml = "";
$path = __DIR__ . "/pedidos_v2.csv";

// Crear archivo si no existe
if (!file_exists($path)) {
    file_put_contents($path, "");
}


// --- FORMULARIO --- //
if (empty($_GET['tamanyo']) || empty($_GET['base']) || empty($_GET['usuario'])) {

    $phtml = "
    <form>
        <p><label for='tamanyo'>Tamaño:</label>
        <select name='tamanyo' id='tamanyo'>";

    foreach($tamanyos as $n => $p) {
        $phtml .= "<option>$n</option>";
    }

    $phtml .= "</select></p>
        <p><label for='base'>Base:</label>
        <select name='base' id='base'>";

    foreach($bases as $n => $p) {
        $phtml .= "<option>$n</option>";
    }

    $phtml .= "</select></p>

        <p><label for='salsa'>Salsa:</label>
        <select name='salsa' id='salsa'>";

    foreach ($salsas as $n => $p) {
        $phtml .= "<option>$n</option>";
    }

    $phtml .= "</select></p>
        <p>";

    foreach ($ingredientes as $n => $p) {
        $phtml .= "<label>$n</label>
                   <input type='checkbox' name='$n'>";
    }

    $phtml .= "</p>
        <p><input type='text' name='usuario' placeholder='Usuario'></p>
        <input type='submit' value='Pedir'>
    </form>";

}
// --------------------------------------------------------- //
// -------------------- PROCESAR PEDIDO -------------------- //
// --------------------------------------------------------- //
else {

    $usuario = $_GET['usuario'];
    $tamanyo = $tamanyos[$_GET['tamanyo']];
    $base = $bases[$_GET['base']];
    $salsa = $salsas[$_GET['salsa']];

    $lista_ingr = [];
    $total = $tamanyo + $base + $salsa;

    // Ingredientes seleccionados
    foreach ($ingredientes as $ing => $precio) {
        if (!empty($_GET[$ing])) {
            $lista_ingr[] = $ing;
            $total += $precio;
        }
    }

    $total_con_descuento = $total;
    $total_usuario = 0;

    // --- LEER CSV PARA CALCULAR GASTO ACUMULADO --- //
    if (($fp = fopen($path, 'r')) !== false) {
        while (($linea = fgetcsv($fp)) !== false) {
            if ($linea[1] == $usuario) {
                $total_usuario += floatval($linea[6]);
                if ($linea[7] == 1) {
                    $total_usuario = 0;
                }
            }
        }
        fclose($fp);
    }

    // --- APLICAR DESCUENTO --- //
    if ($total_usuario > 50 && $total > 10) {
        $total_con_descuento -= 10;
    }

    // --- PREPARAR REGISTRO PARA GUARDAR --- //
    $fields = [];
    $fields[] = date('d-m-Y');
    $fields[] = $usuario;
    $fields[] = $_GET['tamanyo'];
    $fields[] = $_GET['base'];
    $fields[] = $_GET['salsa'];
    $fields[] = implode("+", $lista_ingr);
    $fields[] = $total_con_descuento;
    $fields[] = ($total_con_descuento == $total) ? 0 : 1;


    // --- GUARDAR EN CSV --- //
    if (($fp = fopen($path, 'a+')) !== false) {
        fputcsv($fp, $fields);
        fclose($fp);
    }


    // --- GENERAR FACTURA HTML --- //
    $phtml = "
    <table border='1'>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
        </tr>

        <tr><td>Tamaño {$_GET['tamanyo']}</td>
        <td><strong>".sprintf("%05.2f€", $tamanyo)."</strong></td></tr>

        <tr><td>Base {$_GET['base']}</td>
        <td><strong>".sprintf("%05.2f€", $base)."</strong></td></tr>";

    if ($salsa > 0) {
        $phtml .= "
        <tr><td>Salsa {$_GET['salsa']}</td>
        <td><strong>".sprintf("%05.2f€", $salsa)."</strong></td></tr>";
    }

    foreach ($ingredientes as $ing => $precio) {
        if (!empty($_GET[$ing])) {
            $phtml .= "
            <tr><td>Ingrediente: $ing</td>
            <td><strong>".sprintf("%05.2f€", $precio)."</strong></td></tr>";
        }
    }

    $phtml .= "
        <tr>
            <td><strong>Total</strong></td>
            <td><strong>".sprintf("%05.2f€", $total)."</strong></td>
        </tr>";

    if ($total_con_descuento != $total) {
        $phtml .= "
        <tr>
            <td><strong>Total con descuento</strong></td>
            <td><strong>".sprintf("%05.2f€", $total_con_descuento)."</strong></td>
        </tr>";
    }

    $phtml .= "</table>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pizzería</title>
</head>
<body>
    <?= $phtml ?>
</body>
</html>
