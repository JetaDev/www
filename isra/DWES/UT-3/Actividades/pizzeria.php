<?php
// pizzeria.php - versión súper simple y lista para usar

$prices = [
    'size' => ['mini' => 2.95, 'media' => 4.95, 'maxi' => 8.95],
    'base' => ['normal' => 0.00, 'crujiente' => 1.00, 'rellena' => 2.00],
    'sauce' => ['none' => 0.00, 'barbacoa' => 0.95, 'carbonara' => 1.45],
    'ing'  => ['pollo' => 0.55, 'bacon' => 0.75, 'jamon' => 0.95, 'cebolla' => 0.45, 'aceitunas' => 0.55, 'pimiento' => 0.65]
];

function fmt_euro($v)
{
    // Formato: 2 decimales, coma decimal, símbolo €, entero con al menos 2 cifras
    $v = round((float)$v, 2);
    // number_format con punto decimal, luego lo convertimos a coma
    $s = number_format($v, 2, '.', '');
    list($int, $dec) = explode('.', $s);
    $int = str_pad($int, 2, '0', STR_PAD_LEFT);
    return $int . ',' . $dec . ' €';
}

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$size = $submitted ? ($_POST['size'] ?? 'media') : 'media';
$base = $submitted ? ($_POST['base'] ?? 'normal') : 'normal';
$sauce = $submitted ? ($_POST['sauce'] ?? 'none') : 'none';
$ings  = $submitted ? ($_POST['ings'] ?? []) : [];
if (!is_array($ings)) $ings = [$ings];

$errors = [];
if ($submitted) {
    if (!isset($prices['size'][$size])) $errors[] = 'Tamaño no válido';
    if (!isset($prices['base'][$base])) $errors[] = 'Base no válida';
    if (!isset($prices['sauce'][$sauce])) $errors[] = 'Salsa no válida';
    foreach ($ings as $i) if (!isset($prices['ing'][$i])) $errors[] = 'Ingrediente no válido';
}

$total = 0;
$lines = [];
if ($submitted && empty($errors)) {
    $total += $prices['size'][$size];
    $lines[] = ["Tamaño ($size)", $prices['size'][$size]];
    $total += $prices['base'][$base];
    $lines[] = ["Base ($base)", $prices['base'][$base]];
    if ($sauce !== 'none') {
        $total += $prices['sauce'][$sauce];
        $lines[] = ["Salsa ($sauce)", $prices['sauce'][$sauce]];
    } else $lines[] = ["Salsa (ninguna)", 0];
    if (count($ings) > 0) {
        foreach ($ings as $i) {
            $total += $prices['ing'][$i];
            $lines[] = ["Ingrediente ($i)", $prices['ing'][$i]];
        }
    } else $lines[] = ["Ingredientes (ninguno)", 0];
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Pizzería - súper simple</title>
    <style>
        body {
            font-family: Arial;
            max-width: 700px;
            margin: 20px auto
        }

        label {
            display: block;
            margin: 6px 0
        }

        .right {
            text-align: right
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        td,
        th {
            padding: 6px;
            border-bottom: 1px solid #eee
        }

        .amount {
            font-family: monospace;
            text-align: right
        }
    </style>
</head>

<body>
    <h1>Pizzería - Pedido</h1>
    <form method="post">
        <fieldset>
            <legend>Tamaño</legend>
            <?php foreach ($prices['size'] as $k => $p): ?>
                <label><input type="radio" name="size" value="<?= $k ?>" <?= $size === $k ? "checked" : "" ?>> <?= ucfirst($k) ?> (<?= fmt_euro($p) ?>)</label>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Base</legend>
            <?php foreach ($prices['base'] as $k => $p): ?>
                <label><input type="radio" name="base" value="<?= $k ?>" <?= $base === $k ? "checked" : "" ?>> <?= ucfirst($k) ?> (<?= fmt_euro($p) ?>)</label>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Salsa (opcional)</legend>
            <?php foreach ($prices['sauce'] as $k => $p): ?>
                <label><input type="radio" name="sauce" value="<?= $k ?>" <?= $sauce === $k ? "checked" : "" ?>> <?= $k === 'none' ? 'Ninguna' : ucfirst($k) ?> <?= $k !== 'none' ? "(" . fmt_euro($p) . ")" : "" ?></label>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Ingredientes</legend>
            <?php foreach ($prices['ing'] as $k => $p): ?>
                <label><input type="checkbox" name="ings[]" value="<?= $k ?>" <?= in_array($k, $ings) ? "checked" : "" ?>> <?= ucfirst($k) ?> (<?= fmt_euro($p) ?>)</label>
            <?php endforeach; ?>
        </fieldset>

        <button type="submit">Enviar</button>
    </form>

    <?php if ($submitted): ?>
        <?php if (!empty($errors)): ?>
            <div style="color:darkred"><strong>Errores:</strong>
                <ul><?php foreach ($errors as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?></ul>
            </div>
        <?php else: ?>
            <h2>Factura</h2>
            <table>
                <tr>
                    <th>Concepto</th>
                    <th class="right">Importe</th>
                </tr>
                <?php foreach ($lines as $l): ?>
                    <tr>
                        <td><?= htmlspecialchars($l[0]) ?></td>
                        <td class="amount"><?= fmt_euro($l[1]) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="amount"><strong><?= fmt_euro($total) ?></strong></td>
                </tr>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</body>

</html>
