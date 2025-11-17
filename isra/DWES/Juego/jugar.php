<?php
include 'header.php';

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

$usuario = $_SESSION['usuario_actual'] ?? null;

// Procesar respuestas
$resultados = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pregunta']) && isset($_POST['respuesta'])) {
    $preg = $_POST['pregunta'];
    $resp = $_POST['respuesta'];
    if (isset($preguntas_existentes[$preg])) {
        $correcta = $preguntas_existentes[$preg]['correcta'];
        $resultados[$preg] = $resp == $correcta ? "¡Correcta!" : "Incorrecta. La correcta era: " . $preguntas_existentes[$preg]['opciones'][$correcta];
    }
}
?>

<main style="padding:20px;">
    <h1>Preguntas</h1>

    <?php if (empty($preguntas_existentes)): ?>
        <p>No hay preguntas disponibles.</p>
    <?php else: ?>
        <?php foreach ($preguntas_existentes as $preg => $data): ?>
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px; border-radius:8px;">
                <strong><?php echo htmlspecialchars($preg); ?></strong>
                <ul style="list-style:none; padding-left:0;">
                    <form method="post">
                        <?php foreach ($data['opciones'] as $i => $op): ?>
                            <li>
                                <label>
                                    <input type="radio" name="respuesta" value="<?php echo $i; ?>" required>
                                    <?php echo htmlspecialchars($op); ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                        <input type="hidden" name="pregunta" value="<?php echo htmlspecialchars($preg); ?>">
                        <li>
                            <button type="submit" style="margin-top:5px; padding:4px 8px;">Resolver</button>
                        </li>
                    </form>
                </ul>
                <em>Categoría: <?php echo htmlspecialchars($data['categoria']); ?></em><br>
                <?php if ($usuario === 'isra'): ?>
                    <a href="editar.php?editar=<?php echo urlencode($preg); ?>">Editar</a>
                <?php endif; ?>

                <?php if (isset($resultados[$preg])): ?>
                    <p style="font-weight:bold; margin-top:5px;"><?php echo $resultados[$preg]; ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($usuario === 'isra'): ?>
        <a href="editar.php?nueva=1" style="display:inline-block; margin-top:10px; padding:6px 12px; background:#4caf50; color:#fff; text-decoration:none; border-radius:4px;">Añadir nueva pregunta</a>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
