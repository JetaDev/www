<?php
$title = "Inicio";
include 'header.php';

$usuario = $_SESSION['usuario_actual'] ?? null;
$cuentasDisponibles = leerCSV(__DIR__ . '/jugadores.csv');
?>

<main>
    <h1>Bienvenido al Juego de Preguntas</h1>

    <?php if (!$usuario): ?>
        <div class="error">
            <strong>⚠️ Debes iniciar sesión para jugar</strong>
            <p>Usa el formulario de arriba a la derecha.</p>
        </div>

        <div class="cuentas-disponibles">
            <h3>🔑 Cuentas Disponibles</h3>
            <p>Puedes usar estas cuentas para probar:</p>

            <?php foreach ($cuentasDisponibles as $cuenta): ?>
                <?php if (count($cuenta) >= 2): ?>
                    <div class="cuenta-item">
                        <strong>Usuario:</strong> <?php echo htmlspecialchars($cuenta[0]); ?> |
                        <strong>Contraseña:</strong> <?php echo htmlspecialchars($cuenta[1]); ?>
                        <?php if ($cuenta[0] === 'elchocas'): ?>
                            <span style="color: #ff9800;"> (⭐ Administrador)</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="success">
            <strong>✅ Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</strong>
        </div>
    <?php endif; ?>

    <h2>Instrucciones</h2>
    <p>Juego de preguntas y respuestas. Responde correctamente para ganar puntos.</p>

    <h3>Sistema de Puntuación:</h3>
    <ul>
        <li>Primera acertada: <strong>10 puntos</strong></li>
        <li>Cada acierto duplica: <strong>20, 40, 80, 160...</strong></li>
        <li>Si fallas, vuelve a 10 puntos</li>
        <li>Bonus por completar: <strong>+100 puntos</strong></li>
    </ul>

    <h3>Categorías:</h3>
    <div>
        <span class="categoria categoria-Matemáticas">Matemáticas</span>
        <span class="categoria categoria-Ciencias">Ciencias</span>
        <span class="categoria categoria-Historia">Historia</span>
        <span class="categoria categoria-Literatura">Literatura</span>
        <span class="categoria categoria-Geografía">Geografía</span>
    </div>

    <?php if ($usuario): ?>
        <div style="margin-top: 30px; padding: 20px; background: #2a2a2a; border: 2px solid #4CAF50; border-radius: 5px;">
            <h3 style="color: #4CAF50; margin-top: 0;">🎮 ¿Listo?</h3>
            <a href="jugar.php" class="btn" style="font-size: 1.2em; padding: 15px 30px;">¡Jugar!</a>
        </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
