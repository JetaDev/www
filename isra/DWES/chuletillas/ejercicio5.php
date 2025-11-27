<?php
// Ejercicio 5: Juego de Adivinanza
session_start();

$mensaje = null;
$ganado = false;

// Inicializar juego
if (!isset($_SESSION['numero_secreto']) || isset($_POST['reiniciar'])) {
    $_SESSION['numero_secreto'] = rand(1, 100);
    $_SESSION['intentos'] = 0;
    $_SESSION['historial_intentos'] = [];
    $mensaje = "¡Nuevo juego iniciado! Adivina el número entre 1 y 100";
}

// Procesar intento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adivinar'])) {
    $intento = $_POST['numero'] ?? '';

    if ($intento !== '' && is_numeric($intento)) {
        $intento = intval($intento);
        $_SESSION['intentos']++;
        $_SESSION['historial_intentos'][] = $intento;

        if ($intento === $_SESSION['numero_secreto']) {
            $ganado = true;
            $mensaje = "🎉 ¡FELICIDADES! Adivinaste el número en {$_SESSION['intentos']} intentos";
        } elseif ($intento < $_SESSION['numero_secreto']) {
            $mensaje = "📈 El número secreto es MAYOR que $intento";
        } else {
            $mensaje = "📉 El número secreto es MENOR que $intento";
        }
    } else {
        $mensaje = "Por favor, introduce un número válido";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Juego de Adivinanza</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .numero-intento {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 8px;
            font-weight: bold;
        }
        .game-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }
        .stat-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .stat-box h3 {
            font-size: 2em;
            margin: 0;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎲 Juego de Adivinanza</h1>
        <p class="subtitle">Adivina el número secreto entre 1 y 100</p>

        <?php if ($mensaje): ?>
            <div class="alert <?php echo $ganado ? 'alert-success' : 'alert-info'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="game-stats">
            <div class="stat-box">
                <h3><?php echo $_SESSION['intentos']; ?></h3>
                <p>Intentos realizados</p>
            </div>
            <div class="stat-box">
                <h3>1 - 100</h3>
                <p>Rango de números</p>
            </div>
        </div>

        <?php if (!$ganado): ?>
            <form method="POST" action="" style="background: #f5f5f5; padding: 20px; border-radius: 10px;">
                <div class="form-group">
                    <label for="numero">Tu intento:</label>
                    <input type="number" id="numero" name="numero"
                           min="1" max="100"
                           placeholder="Introduce un número del 1 al 100"
                           required autofocus>
                </div>

                <button type="submit" name="adivinar" class="btn">Adivinar</button>
                <button type="submit" name="reiniciar" class="btn btn-secondary">Nuevo Juego</button>
            </form>
        <?php else: ?>
            <form method="POST" action="">
                <button type="submit" name="reiniciar" class="btn btn-success" style="width: 100%; padding: 20px; font-size: 1.2em;">
                    🎮 Jugar de Nuevo
                </button>
            </form>
        <?php endif; ?>

        <?php if (!empty($_SESSION['historial_intentos'])): ?>
            <div style="margin-top: 30px;">
                <h2>📊 Historial de Intentos</h2>
                <div style="background: #f5f5f5; padding: 20px; border-radius: 10px; text-align: center;">
                    <?php foreach ($_SESSION['historial_intentos'] as $index => $num): ?>
                        <span class="numero-intento">
                            <?php echo ($index + 1) . ': ' . htmlspecialchars($num); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php
            $min_intento = min($_SESSION['historial_intentos']);
            $max_intento = max($_SESSION['historial_intentos']);
            ?>
            <div style="margin-top: 20px; background: #e3f2fd; padding: 15px; border-radius: 10px;">
                <h3>📈 Estadísticas</h3>
                <p><strong>Número más bajo intentado:</strong> <?php echo $min_intento; ?></p>
                <p><strong>Número más alto intentado:</strong> <?php echo $max_intento; ?></p>
                <p><strong>Rango explorado:</strong> <?php echo ($max_intento - $min_intento); ?> números</p>
            </div>
        <?php endif; ?>

        <?php if ($ganado): ?>
            <div style="margin-top: 20px; background: #c8e6c9; padding: 20px; border-radius: 10px; text-align: center;">
                <h2>🏆 ¡Victoria!</h2>
                <p style="font-size: 1.5em;">El número secreto era: <strong><?php echo $_SESSION['numero_secreto']; ?></strong></p>
                <p>Lo adivinaste en <strong><?php echo $_SESSION['intentos']; ?></strong> intentos</p>
            </div>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
