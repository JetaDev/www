<?php
// Ejercicio 1: Calculadora con Sesiones
session_start();

// Inicializar historial si no existe
if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = [];
}

$resultado = null;
$error = null;

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['calcular'])) {
        $num1 = $_POST['num1'] ?? '';
        $num2 = $_POST['num2'] ?? '';
        $operacion = $_POST['operacion'] ?? '';

        if ($num1 !== '' && $num2 !== '' && is_numeric($num1) && is_numeric($num2)) {
            $num1 = floatval($num1);
            $num2 = floatval($num2);

            if ($operacion === 'suma') {
                $resultado = $num1 + $num2;
                $simbolo = '+';
            } elseif ($operacion === 'resta') {
                $resultado = $num1 - $num2;
                $simbolo = '-';
            } elseif ($operacion === 'multiplicacion') {
                $resultado = $num1 * $num2;
                $simbolo = '×';
            } elseif ($operacion === 'division') {
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                    $simbolo = '÷';
                } else {
                    $error = "No se puede dividir entre cero";
                }
            }

            if ($resultado !== null) {
                $operacionTexto = "$num1 $simbolo $num2 = $resultado";
                $_SESSION['historial'][] = [
                    'operacion' => $operacionTexto,
                    'fecha' => date('H:i:s')
                ];
            }
        } else {
            $error = "Por favor, introduce números válidos";
        }
    } elseif (isset($_POST['limpiar'])) {
        $_SESSION['historial'] = [];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Calculadora con Sesiones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>🔢 Calculadora con Sesiones</h1>
        <p class="subtitle">El historial se guarda en la sesión del servidor</p>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($resultado !== null): ?>
            <div class="alert alert-success">
                <strong>Resultado:</strong> <?php echo htmlspecialchars($resultado); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="num1">Primer número:</label>
                <input type="number" step="any" id="num1" name="num1" required>
            </div>

            <div class="form-group">
                <label for="operacion">Operación:</label>
                <select id="operacion" name="operacion" required>
                    <option value="suma">Suma (+)</option>
                    <option value="resta">Resta (-)</option>
                    <option value="multiplicacion">Multiplicación (×)</option>
                    <option value="division">División (÷)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="num2">Segundo número:</label>
                <input type="number" step="any" id="num2" name="num2" required>
            </div>

            <button type="submit" name="calcular" class="btn">Calcular</button>
            <button type="submit" name="limpiar" class="btn btn-danger">Limpiar Historial</button>
        </form>

        <?php if (!empty($_SESSION['historial'])): ?>
            <h2 style="margin-top: 30px;">📋 Historial de Operaciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Operación</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_reverse($_SESSION['historial']) as $index => $item): ?>
                        <tr>
                            <td><?php echo count($_SESSION['historial']) - $index; ?></td>
                            <td><?php echo htmlspecialchars($item['operacion']); ?></td>
                            <td><?php echo htmlspecialchars($item['fecha']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="margin-top: 20px; color: #666; text-align: center;">No hay operaciones en el historial</p>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
