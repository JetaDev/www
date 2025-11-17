<?php
// Precios y configuración
$precios = [
    'tamanos' => ['mini' => 2.95, 'media' => 4.95, 'maxi' => 8.95],
    'bases' => ['normal' => 0.00, 'crujiente' => 1.00, 'rellena' => 2.00],
    'salsas' => ['ninguna' => 0.00, 'barbacoa' => 0.95, 'carbonara' => 1.45],
    'ingredientes' => ['pollo' => 0.55, 'bacon' => 0.75, 'jamon' => 0.95, 'cebolla' => 0.45, 'aceitunas' => 0.55, 'pimiento' => 0.65]
];
$archivo_pedidos = __DIR__ . '/pedidos.csv';
$separador_ingredientes = '+';

// --- Funciones ---

$mostrar_euro = fn(float $precio): string =>
number_format($precio, 2, ',', '') . " €";

function leer_pedidos(string $archivo, string $sep_ing): array
{
    $pedidos = [];
    if (!file_exists($archivo) || ($handle = fopen($archivo, 'r')) === false) {
        return $pedidos;
    }
    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) < 8) continue;
        $pedidos[] = [
            'fecha' => $data[0],
            'usuario' => $data[1],
            'tamano' => $data[2],
            'base' => $data[3],
            'salsa' => $data[4],
            // AHORA: Usamos el separador '+' para convertir la cadena en un array
            'ingredientes' => $data[5] ? explode($sep_ing, $data[5]) : [],
            'total' => (float)$data[6],
            'descuento' => (int)$data[7]
        ];
    }
    fclose($handle);
    return $pedidos;
}

function guardar_pedido($archivo, $usuario, $tamano, $base, $salsa, $ingredientes, $total, $descuento, string $sep_ing)
{
    $fila = [
        date('Y-m-d H:i:s'),
        $usuario,
        $tamano,
        $base,
        $salsa,
        // AHORA: Usamos el separador '+' para unir los ingredientes en una cadena
        implode($sep_ing, $ingredientes),
        number_format($total, 2, '.', ''),
        $descuento
    ];
    // Usamos fputcsv para guardar la fila. Como el separador de ingredientes ya no es una coma, funciona bien.
    $handle = fopen($archivo, 'a');
    fputcsv($handle, $fila);
    fclose($handle);
}

// Lógica de Descuento (Mantenida como la versión robusta)
function descuento_pendiente(array $historial, string $usuario): bool
{
    $gasto_acumulado = 0.0;
    $descuentos_usados = 0;

    foreach ($historial as $pedido) {
        if ($pedido['usuario'] !== $usuario) continue;

        $gasto_real = $pedido['total'] + ($pedido['descuento'] ? 10.00 : 0.00);
        $gasto_acumulado += $gasto_real;

        if ($pedido['descuento']) {
            $descuentos_usados++;
        }
    }

    $descuentos_ganados = floor($gasto_acumulado / 50.00);
    return ($descuentos_ganados - $descuentos_usados) > 0;
}


// --- Procesamiento del Formulario ---

$enviado = $_SERVER['REQUEST_METHOD'] === 'POST';
$errores = [];
$factura = [];
$aplico_descuento = 0;
$total = 0.0;

// Obtener datos
$usuario = $enviado ? trim($_POST['usuario'] ?? '') : '';
$tamano = $enviado ? $_POST['tamano'] ?? 'media' : 'media';
$base = $enviado ? $_POST['base'] ?? 'normal' : 'normal';
$salsa = $enviado ? $_POST['salsa'] ?? 'ninguna' : 'ninguna';
$ingredientes = $enviado ? (array)($_POST['ingredientes'] ?? []) : [];


if ($enviado) {

    // 2. Cálculo del total
    if (empty($errores)) {

        // Suma de componentes
        foreach (['tamanos' => $tamano, 'bases' => $base, 'salsas' => $salsa] as $cat_key => $val) {
            $total += $precios[$cat_key][$val];
            $factura[] = [ucfirst(rtrim($cat_key, 's')) . " ($val)", $precios[$cat_key][$val]];
        }

        // Ingredientes
        if ($ingredientes) {
            foreach ($ingredientes as $i) {
                $total += $precios['ingredientes'][$i];
                $factura[] = ["Ingrediente ($i)", $precios['ingredientes'][$i]];
            }
        } else {
            $factura[] = ["Ingredientes (ninguno)", 0.0];
        }

        // 3. Aplicar Descuento de Fidelidad
        $historial = leer_pedidos($archivo_pedidos, $separador_ingredientes); // Pasamos el separador

        if (descuento_pendiente($historial, $usuario)) {
            $aplico_descuento = 1;
            $total = max(0.0, $total - 10.00);
            $factura[] = ["**DESCUENTO POR FIDELIDAD (-10€)**", -10.00];
        }

        // 4. Guardar Pedido
        guardar_pedido($archivo_pedidos, $usuario, $tamano, $base, $salsa, $ingredientes, $total, $aplico_descuento, $separador_ingredientes); // Pasamos el separador
    }
}

// Incluir la plantilla HTML
include 'form.php';
