<?php
include 'header.php';

$usuario = $_SESSION['usuario_actual'] ?? null;

// Categorías
$categorias = ['Matemáticas', 'Ciencias', 'Historia', 'Literatura', 'Geografía'];

// Array simulado de preguntas
$preguntas_existentes = [
    '¿Capital de España?' => [
        'opciones' => ['Madrid', 'Barcelona', 'Valencia'],
        'correcta' => 0,
        'categoria' => 'Geografía'
    ],
    '¿2+2=?' => [
        'opciones' => ['3', '4', '5'],
        'correcta' => 1,
        'categoria' => 'Matemáticas'
    ]
];

// Variables del formulario
$mensaje = '';
$form = false;
$datos_form = [
    'pregunta' => '',
    'opciones' => ['', '', ''],
    'correcta' => 0,
    'categoria' => ''
];

// Determinar si se está editando o creando nueva
$editar = $_GET['editar'] ?? '';
$nueva = $_GET['nueva'] ?? '';

// Cargar datos si se edita
if ($editar && isset($preguntas_existentes[$editar])) {
    $form = true;
    $datos_form = $preguntas_existentes[$editar];
    $datos_form['pregunta'] = $editar;
} elseif ($nueva) {
    // Solo "isra" puede añadir
    if ($usuario !== 'isra') {
        echo "<main style='padding:20px;'><p>No tienes permisos para añadir nuevas preguntas.</p></main>";
        include 'footer.php';
        exit;
    }
    $form = true;
}

// Procesar "guardar" (simulado)
if (isset($_POST['guardar'])) {
    $pregunta = trim($_POST['pregunta'] ?? '');
    $opciones = [
        trim($_POST['op1'] ?? ''),
        trim($_POST['op2'] ?? ''),
        trim($_POST['op3'] ?? '')
    ];
    $correcta = $_POST['correcta'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    if ($pregunta === '' || in_array('', $opciones) || $correcta === '' || $categoria === '') {
        $mensaje = "Falta información de la pregunta. Por favor completa todos los campos.";
        $form = true;
        $datos_form = [
            'pregunta' => $pregunta,
            'opciones' => $opciones,
            'correcta' => $correcta,
            'categoria' => $categoria
        ];
    } else {
        $mensaje = "Pregunta guardada correctamente (simulado).";
        $form = false;
    }
}
?>

<main style="padding:20px;">
    <h1><?php echo $editar ? "Modificar pregunta" : "Añadir nueva pregunta"; ?></h1>

    <?php if ($mensaje): ?>
        <p style="color:<?php echo strpos($mensaje, 'correctamente') !== false ? 'green' : 'red'; ?>;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <?php if ($form): ?>
        <form method="post">
            <input type="hidden" name="editar" value="<?php echo htmlspecialchars($editar); ?>">
            <label>Pregunta:<br>
                <input type="text" name="pregunta" value="<?php echo htmlspecialchars($datos_form['pregunta']); ?>" required style="width: 400px;">
            </label><br><br>

            <label>Opción 1:<br>
                <input type="text" name="op1" value="<?php echo htmlspecialchars($datos_form['opciones'][0]); ?>" required>
            </label><br>
            <label>Opción 2:<br>
                <input type="text" name="op2" value="<?php echo htmlspecialchars($datos_form['opciones'][1]); ?>" required>
            </label><br>
            <label>Opción 3:<br>
                <input type="text" name="op3" value="<?php echo htmlspecialchars($datos_form['opciones'][2]); ?>" required>
            </label><br><br>

            <label>Opción correcta:
                <select name="correcta" required>
                    <option value="">Selecciona</option>
                    <option value="0" <?php if ($datos_form['correcta'] == 0) echo 'selected'; ?>>Opción 1</option>
                    <option value="1" <?php if ($datos_form['correcta'] == 1) echo 'selected'; ?>>Opción 2</option>
                    <option value="2" <?php if ($datos_form['correcta'] == 2) echo 'selected'; ?>>Opción 3</option>
                </select>
            </label><br><br>

            <label>Categoría:
                <select name="categoria" required>
                    <option value="">Selecciona categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat); ?>" <?php if ($datos_form['categoria'] == $cat) echo 'selected'; ?>><?php echo htmlspecialchars($cat); ?></option>
                    <?php endforeach; ?>
                </select>
            </label><br><br>

            <button type="submit" name="guardar">Guardar</button>
        </form>
    <?php else: ?>
        <a href="jugar.php" style="display:inline-block; margin-top:10px;">Volver a preguntas</a>

        <?php if (!empty($preguntas)): ?>
            <h2>JSON temporal de preguntas</h2>
            <pre><?php echo json_encode($preguntas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?></pre>
        <?php endif; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
