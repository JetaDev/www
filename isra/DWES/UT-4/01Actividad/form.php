<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Pizzería - Pedido</title>
    <style>
        /* Estilo básico para resaltar errores */
        .error {
            border: 1px solid red;
            background-color: #fee;
            padding: 10px;
            margin-top: 20px;
            color: #d8000c;
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Pizzería - Pedido</h1>

    <form method="post">
        <fieldset>
            <legend>Cliente</legend>
            <label>Nombre: <input type="text" name="usuario" value="<?= htmlspecialchars($usuario) ?>"></label>
        </fieldset>

        <fieldset>
            <legend>Tamaño</legend>
            <?php foreach ($precios['tamanos'] as $k => $p): ?>
                <label>
                    <input type="radio" name="tamano" value="<?= $k ?>" <?= $tamano === $k ? 'checked' : '' ?>>
                    <?= ucfirst($k) ?> (<?= $mostrar_euro($p) ?>)
                </label><br>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Base</legend>
            <?php foreach ($precios['bases'] as $k => $p): ?>
                <label>
                    <input type="radio" name="base" value="<?= $k ?>" <?= $base === $k ? 'checked' : '' ?>>
                    <?= ucfirst($k) ?> (<?= $mostrar_euro($p) ?>)
                </label><br>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Salsa</legend>
            <?php foreach ($precios['salsas'] as $k => $p): ?>
                <label>
                    <input type="radio" name="salsa" value="<?= $k ?>" <?= $salsa === $k ? 'checked' : '' ?>>
                    <?= ucfirst($k) ?> (<?= $mostrar_euro($p) ?>)
                </label><br>
            <?php endforeach; ?>
        </fieldset>

        <fieldset>
            <legend>Ingredientes</legend>
            <?php foreach ($precios['ingredientes'] as $k => $p): ?>
                <label>
                    <input type="checkbox" name="ingredientes[]" value="<?= $k ?>" <?= in_array($k, $ingredientes) ? 'checked' : '' ?>>
                    <?= ucfirst($k) ?> (<?= $mostrar_euro($p) ?>)
                </label><br>
            <?php endforeach; ?>
        </fieldset>

        <button type="submit">Enviar pedido</button>
    </form>

    <?php if ($enviado): ?>
        <hr>
        <?php if (!empty($errores)): ?>
            <div class="error">
                <strong>❌ Error al procesar el pedido:</strong>
                <ul>
                    <?php foreach ($errores as $e) echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
                </ul>
                <p>Por favor, revisa tu selección.</p>
            </div>
        <?php else: ?>
            <h2>✅ Factura del Pedido</h2>
            <table>
                <tr>
                    <th>Concepto</th>
                    <th>Precio</th>
                </tr>
                <?php foreach ($factura as $f): ?>
                    <tr>
                        <td><?= htmlspecialchars($f[0]) ?></td>
                        <td><?= $mostrar_euro($f[1]) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>**Estado Descuento Fidelidad**</td>
                    <td><?= $aplico_descuento ? 'Aplicado (-10€)' : 'No Aplicado' ?></td>
                </tr>
                <tr>
                    <td><strong>TOTAL FINAL</strong></td>
                    <td><strong><?= $mostrar_euro($total) ?></strong></td>
                </tr>
            </table>
            <p>Tu pedido ha sido guardado con éxito. ¡Gracias por tu compra!</p>
        <?php endif; ?>
    <?php endif; ?>

</body>

</html>
