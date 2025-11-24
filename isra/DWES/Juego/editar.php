<?php
$title = "Editar Preguntas";
include 'header.php';

$usuario = $_SESSION['usuario_actual'] ?? null;

if ($usuario !== 'elchocas') {
    echo '<main><div class="error"><p>Solo el usuario "elchocas" puede acceder</p></div></main>';
    include 'footer.php';
    exit;
}

$categorias = ['Matemáticas', 'Ciencias', 'Historia', 'Literatura', 'Geografía'];
$todasPreguntas = cargarPreguntas();
$mensaje = '';
$tipoMensaje = '';
$modoEdicion = false;
$preguntaEditar = null;
$datosFormulario = ['enunciado' => '', 'opciones' => ['', '', ''], 'correcta' => '', 'categoria' => ''];

if (isset($_GET['modificar']) && $_GET['modificar'] !== '') {
    $indiceModificar = (int)$_GET['modificar'];
    if (isset($todasPreguntas[$indiceModificar])) {
        $modoEdicion = true;
        $preguntaEditar = $indiceModificar;
        $datosFormulario = $todasPreguntas[$indiceModificar];
    }
} elseif (isset($_GET['nueva'])) {
    $modoEdicion = true;
}

// Guardar pregunta con GET
if (isset($_GET['guardar'])) {
    $enunciado = trim($_GET['enunciado'] ?? '');
    $opcion1 = trim($_GET['opcion1'] ?? '');
    $opcion2 = trim($_GET['opcion2'] ?? '');
    $opcion3 = trim($_GET['opcion3'] ?? '');
    $correcta = $_GET['correcta'] ?? '';
    $categoria = $_GET['categoria'] ?? '';
    $indiceOriginal = $_GET['indice_original'] ?? '';

    if (empty($enunciado) || empty($opcion1) || empty($opcion2) || empty($opcion3) || $correcta === '' || empty($categoria)) {
        $mensaje = "❌ Completa todos los campos";
        $tipoMensaje = 'error';
        $modoEdicion = true;
        $datosFormulario = ['enunciado' => $enunciado, 'opciones' => [$opcion1, $opcion2, $opcion3], 'correcta' => $correcta, 'categoria' => $categoria];
    } else {
        $nuevaPregunta = ['enunciado' => $enunciado, 'opciones' => [$opcion1, $opcion2, $opcion3], 'correcta' => (int)$correcta, 'categoria' => $categoria];

        if ($indiceOriginal !== '') {
            $indice = (int)$indiceOriginal;
            if (isset($todasPreguntas[$indice])) {
                guardarPregunta($nuevaPregunta, $todasPreguntas[$indice]['enunciado']);
                $mensaje = "✅ Pregunta modificada correctamente";
            }
        } else {
            guardarPregunta($nuevaPregunta);
            $mensaje = "✅ Pregunta añadida correctamente";
        }

        $tipoMensaje = 'success';
        $modoEdicion = false;
        $todasPreguntas = cargarPreguntas();
    }
}
?>

<main>
    <h1>✏️ Editar Preguntas</h1>

    <?php if ($mensaje): ?>
        <div class="<?php echo $tipoMensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <?php if (!$modoEdicion): ?>
        <a href="editar.php?nueva=1" class="btn">➕ Nueva Pregunta</a>

        <h3>Modificar Pregunta Existente:</h3>
        <form method="get">
            <select name="modificar" onchange="this.form.submit()">
                <option value="">-- Selecciona --</option>
                <?php foreach ($todasPreguntas as $i => $p): ?>
                    <option value="<?php echo $i; ?>"><?php echo htmlspecialchars($p['enunciado']); ?></option>
                <?php endforeach; ?>
            </select>
        </form>

        <h3>Preguntas (<?php echo count($todasPreguntas); ?>)</h3>
        <?php foreach ($todasPreguntas as $i => $p): ?>
            <div class="pregunta-card">
                <span class="categoria categoria-<?php echo htmlspecialchars($p['categoria']); ?>">
                    <?php echo htmlspecialchars($p['categoria']); ?>
                </span>
                <h4><?php echo htmlspecialchars($p['enunciado']); ?></h4>
                <ul>
                    <?php foreach ($p['opciones'] as $j => $op): ?>
                        <li <?php if ($j === $p['correcta']) echo 'style="color: #4CAF50;"'; ?>>
                            <?php echo htmlspecialchars($op); ?> <?php if ($j === $p['correcta']) echo '✓'; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="editar.php?modificar=<?php echo $i; ?>" class="btn">Modificar</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h2><?php echo ($preguntaEditar !== null) ? 'Modificar' : 'Nueva'; ?> Pregunta</h2>

        <form method="get">
            <?php if ($preguntaEditar !== null): ?>
                <input type="hidden" name="indice_original" value="<?php echo $preguntaEditar; ?>">
            <?php endif; ?>

            <label>Enunciado: *</label>
            <input type="text" name="enunciado" value="<?php echo htmlspecialchars($datosFormulario['enunciado']); ?>" required>

            <label>Opción 1: *</label>
            <input type="text" name="opcion1" value="<?php echo htmlspecialchars($datosFormulario['opciones'][0] ?? ''); ?>" required>

            <label>Opción 2: *</label>
            <input type="text" name="opcion2" value="<?php echo htmlspecialchars($datosFormulario['opciones'][1] ?? ''); ?>" required>

            <label>Opción 3: *</label>
            <input type="text" name="opcion3" value="<?php echo htmlspecialchars($datosFormulario['opciones'][2] ?? ''); ?>" required>

            <label>Opción Correcta: *</label>
            <select name="correcta" required>
                <option value="">Selecciona</option>
                <option value="0" <?php if (($datosFormulario['correcta'] ?? '') === 0) echo 'selected'; ?>>Opción 1</option>
                <option value="1" <?php if (($datosFormulario['correcta'] ?? '') === 1) echo 'selected'; ?>>Opción 2</option>
                <option value="2" <?php if (($datosFormulario['correcta'] ?? '') === 2) echo 'selected'; ?>>Opción 3</option>
            </select>

            <label>Categoría: *</label>
            <select name="categoria" required>
                <option value="">Selecciona</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>" <?php if (($datosFormulario['categoria'] ?? '') === $cat) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($cat); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="hidden" name="guardar" value="1">
            <button type="submit">💾 Guardar</button>
            <a href="editar.php" class="btn" style="background: #666;">Cancelar</a>
        </form>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
