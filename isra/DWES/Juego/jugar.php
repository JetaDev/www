<?php
$title = "Jugar";
include 'header.php';

$usuario = $_SESSION['usuario_actual'] ?? null;

if (!$usuario) {
    echo '<main><div class="error"><p>Debes iniciar sesión para jugar</p></div></main>';
    include 'footer.php';
    exit;
}

// Inicializar partida
if (!isset($_SESSION['partida_actual'])) {
    $todasPreguntas = cargarPreguntas();
    shuffle($todasPreguntas);

    $_SESSION['partida_actual'] = [
        'preguntas' => $todasPreguntas,
        'indice_actual' => 0,
        'puntuacion' => 0,
        'acertadas' => 0,
        'respondidas' => 0,
        'racha' => 10,
        'completada' => false
    ];
}

$partida = &$_SESSION['partida_actual'];

// Responder pregunta con GET
if (isset($_GET['responder']) && isset($_GET['respuesta'])) {
    $respuesta = (int)$_GET['respuesta'];
    $preguntaActual = $partida['preguntas'][$partida['indice_actual']];

    $partida['respondidas']++;

    if ($respuesta === $preguntaActual['correcta']) {
        $partida['acertadas']++;
        $partida['puntuacion'] += $partida['racha'];
        $_SESSION['mensaje_respuesta'] = "✅ ¡Correcto! +" . $partida['racha'] . " puntos";
        $_SESSION['tipo_mensaje'] = 'success';
        $partida['racha'] *= 2;
    } else {
        $opcionCorrecta = $preguntaActual['opciones'][$preguntaActual['correcta']];
        $_SESSION['mensaje_respuesta'] = "❌ Incorrecto. Era: " . htmlspecialchars($opcionCorrecta);
        $_SESSION['tipo_mensaje'] = 'error';
        $partida['racha'] = 10;
    }

    $partida['indice_actual']++;

    if ($partida['indice_actual'] >= count($partida['preguntas'])) {
        $partida['puntuacion'] += 100;
        $partida['completada'] = true;
        guardarPartida($usuario, $partida['puntuacion'], $partida['respondidas'], $partida['acertadas']);
        $_SESSION['mensaje_respuesta'] = "🎉 ¡Completado! Bonus +100 puntos";
        $_SESSION['tipo_mensaje'] = 'success';
    }
}

// Finalizar partida con GET
if (isset($_GET['finalizar']) && $_GET['finalizar'] === '1') {
    guardarPartida($usuario, $partida['puntuacion'], $partida['respondidas'], $partida['acertadas']);
    $_SESSION['mensaje_respuesta'] = "🏁 Partida finalizada. Puntos: " . $partida['puntuacion'];
    $_SESSION['tipo_mensaje'] = 'success';
    $partida['completada'] = true;
}

// Nueva partida con GET
if (isset($_GET['nueva'])) {
    unset($_SESSION['partida_actual']);
    unset($_SESSION['mensaje_respuesta']);
}

$preguntaActual = null;
$hayMasPreguntas = false;

if ($partida['indice_actual'] < count($partida['preguntas'])) {
    $preguntaActual = $partida['preguntas'][$partida['indice_actual']];
    $hayMasPreguntas = true;
}
?>

<main>
    <h1>🎯 Jugar</h1>

    <?php if (isset($_SESSION['mensaje_respuesta'])): ?>
        <div class="<?php echo $_SESSION['tipo_mensaje']; ?>">
            <?php echo $_SESSION['mensaje_respuesta']; ?>
        </div>
        <?php unset($_SESSION['mensaje_respuesta']); unset($_SESSION['tipo_mensaje']); ?>
    <?php endif; ?>

    <div class="puntuacion">
        <div><div class="numero"><?php echo $partida['puntuacion']; ?></div><div class="label">Puntos</div></div>
        <div><div class="numero"><?php echo $partida['respondidas']; ?></div><div class="label">Respondidas</div></div>
        <div><div class="numero"><?php echo $partida['acertadas']; ?></div><div class="label">Acertadas</div></div>
        <div><div class="numero"><?php echo $partida['racha']; ?></div><div class="label">Siguiente Vale</div></div>
    </div>

    <?php if ($partida['completada']): ?>
        <div class="success" style="text-align: center; padding: 30px;">
            <h2>🎉 ¡Partida Finalizada!</h2>
            <p style="font-size: 1.2em;">Puntuación: <strong><?php echo $partida['puntuacion']; ?></strong></p>
            <p>Respondidas: <?php echo $partida['respondidas']; ?> | Acertadas: <?php echo $partida['acertadas']; ?></p>
            <a href="jugar.php?nueva=1" class="btn">🔄 Nueva Partida</a>
            <a href="mejores.php" class="btn">🏆 Ver Ranking</a>
        </div>
    <?php elseif ($hayMasPreguntas): ?>
        <div class="pregunta-card">
            <span class="categoria categoria-<?php echo htmlspecialchars($preguntaActual['categoria']); ?>">
                <?php echo htmlspecialchars($preguntaActual['categoria']); ?>
            </span>

            <h3>Pregunta <?php echo $partida['indice_actual'] + 1; ?> de <?php echo count($partida['preguntas']); ?></h3>
            <h2><?php echo htmlspecialchars($preguntaActual['enunciado']); ?></h2>

            <form method="get">
                <ul class="opciones">
                    <?php foreach ($preguntaActual['opciones'] as $i => $opcion): ?>
                        <li>
                            <label style="cursor: pointer; display: block;">
                                <input type="radio" name="respuesta" value="<?php echo $i; ?>" required>
                                <?php echo htmlspecialchars($opcion); ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <input type="hidden" name="responder" value="1">
                <button type="submit">✓ Responder</button>
                <a href="jugar.php?finalizar=1" class="btn" style="background: #f44336;" onclick="return confirm('¿Finalizar sin bonus?');">🏁 Finalizar</a>
            </form>
        </div>
    <?php else: ?>
        <div class="error"><p>No hay preguntas disponibles</p></div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
