<?php
// Ejercicio 7: Encuesta con Resultados
session_start();

// Inicializar resultados si no existen
if (!isset($_SESSION['resultados_encuesta'])) {
    $_SESSION['resultados_encuesta'] = [
        'lenguajes' => [],
        'experiencia' => [],
        'frameworks' => []
    ];
}

// Verificar si ya votó (usando cookie)
$yaVoto = isset($_COOKIE['encuesta_votada']);

$mensaje = null;

// Procesar encuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar']) && !$yaVoto) {
    $lenguaje = $_POST['lenguaje'] ?? '';
    $experiencia = $_POST['experiencia'] ?? '';
    $frameworks = $_POST['frameworks'] ?? [];

    if ($lenguaje !== '' && $experiencia !== '') {
        // Guardar respuestas
        if (!isset($_SESSION['resultados_encuesta']['lenguajes'][$lenguaje])) {
            $_SESSION['resultados_encuesta']['lenguajes'][$lenguaje] = 0;
        }
        $_SESSION['resultados_encuesta']['lenguajes'][$lenguaje]++;

        if (!isset($_SESSION['resultados_encuesta']['experiencia'][$experiencia])) {
            $_SESSION['resultados_encuesta']['experiencia'][$experiencia] = 0;
        }
        $_SESSION['resultados_encuesta']['experiencia'][$experiencia]++;

        foreach ($frameworks as $framework) {
            if (!isset($_SESSION['resultados_encuesta']['frameworks'][$framework])) {
                $_SESSION['resultados_encuesta']['frameworks'][$framework] = 0;
            }
            $_SESSION['resultados_encuesta']['frameworks'][$framework]++;
        }

        // Marcar como votado con cookie
        setcookie('encuesta_votada', '1', time() + (30 * 24 * 60 * 60), '/');
        $yaVoto = true;
        $mensaje = "¡Gracias por participar en la encuesta!";
    }
} elseif (isset($_POST['reiniciar'])) {
    $_SESSION['resultados_encuesta'] = [
        'lenguajes' => [],
        'experiencia' => [],
        'frameworks' => []
    ];
    $mensaje = "Resultados reiniciados";
}

// Calcular total de votos
$totalVotos = array_sum($_SESSION['resultados_encuesta']['lenguajes']);

$lenguajesDisponibles = [
    'php' => 'PHP',
    'javascript' => 'JavaScript',
    'python' => 'Python',
    'java' => 'Java',
    'csharp' => 'C#'
];

$nivelesExperiencia = [
    'principiante' => 'Principiante (< 1 año)',
    'intermedio' => 'Intermedio (1-3 años)',
    'avanzado' => 'Avanzado (3-5 años)',
    'experto' => 'Experto (> 5 años)'
];

$frameworksDisponibles = [
    'laravel' => 'Laravel',
    'symfony' => 'Symfony',
    'react' => 'React',
    'vue' => 'Vue.js',
    'angular' => 'Angular',
    'django' => 'Django'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 - Encuesta con Resultados</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .barra-progreso {
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }
        .barra-relleno {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px;
            text-align: right;
            font-weight: bold;
            transition: width 0.5s ease;
        }
        .resultado-item {
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Encuesta de Desarrollo Web</h1>
        <p class="subtitle">Comparte tu experiencia y ve los resultados en tiempo real</p>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <?php if (!$yaVoto): ?>
            <!-- Formulario de encuesta -->
            <form method="POST" action="" style="background: #f5f5f5; padding: 25px; border-radius: 10px;">
                <div class="form-group">
                    <label for="lenguaje">¿Cuál es tu lenguaje de programación favorito?</label>
                    <select id="lenguaje" name="lenguaje" required>
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($lenguajesDisponibles as $key => $nombre): ?>
                            <option value="<?php echo $key; ?>"><?php echo htmlspecialchars($nombre); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="experiencia">¿Cuál es tu nivel de experiencia?</label>
                    <select id="experiencia" name="experiencia" required>
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($nivelesExperiencia as $key => $nombre): ?>
                            <option value="<?php echo $key; ?>"><?php echo htmlspecialchars($nombre); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>¿Qué frameworks has usado? (puedes seleccionar varios)</label>
                    <?php foreach ($frameworksDisponibles as $key => $nombre): ?>
                        <div style="margin: 8px 0;">
                            <input type="checkbox" id="fw_<?php echo $key; ?>"
                                   name="frameworks[]" value="<?php echo $key; ?>">
                            <label for="fw_<?php echo $key; ?>" style="display: inline; margin-left: 8px;">
                                <?php echo htmlspecialchars($nombre); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" name="enviar" class="btn">Enviar Respuestas</button>
            </form>
        <?php else: ?>
            <div class="alert alert-info">
                ✅ Ya has participado en esta encuesta. ¡Gracias por tu voto!
            </div>
        <?php endif; ?>

        <!-- Resultados -->
        <?php if ($totalVotos > 0): ?>
            <h2 style="margin-top: 40px;">📈 Resultados de la Encuesta</h2>
            <p style="text-align: center; color: #666;">Total de participantes: <strong><?php echo $totalVotos; ?></strong></p>

            <!-- Lenguajes favoritos -->
            <div style="background: white; padding: 20px; border-radius: 10px; margin: 20px 0;">
                <h3>💻 Lenguajes de Programación Favoritos</h3>
                <?php
                arsort($_SESSION['resultados_encuesta']['lenguajes']);
                foreach ($_SESSION['resultados_encuesta']['lenguajes'] as $lenguaje => $votos):
                    $porcentaje = ($votos / $totalVotos) * 100;
                ?>
                    <div class="resultado-item">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span><strong><?php echo htmlspecialchars($lenguajesDisponibles[$lenguaje] ?? $lenguaje); ?></strong></span>
                            <span><?php echo $votos; ?> votos (<?php echo number_format($porcentaje, 1); ?>%)</span>
                        </div>
                        <div class="barra-progreso">
                            <div class="barra-relleno" style="width: <?php echo $porcentaje; ?>%">
                                <?php echo number_format($porcentaje, 1); ?>%
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Niveles de experiencia -->
            <div style="background: white; padding: 20px; border-radius: 10px; margin: 20px 0;">
                <h3>📚 Niveles de Experiencia</h3>
                <?php
                arsort($_SESSION['resultados_encuesta']['experiencia']);
                foreach ($_SESSION['resultados_encuesta']['experiencia'] as $nivel => $votos):
                    $porcentaje = ($votos / $totalVotos) * 100;
                ?>
                    <div class="resultado-item">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span><strong><?php echo htmlspecialchars($nivelesExperiencia[$nivel] ?? $nivel); ?></strong></span>
                            <span><?php echo $votos; ?> votos (<?php echo number_format($porcentaje, 1); ?>%)</span>
                        </div>
                        <div class="barra-progreso">
                            <div class="barra-relleno" style="width: <?php echo $porcentaje; ?>%">
                                <?php echo number_format($porcentaje, 1); ?>%
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Frameworks -->
            <?php if (!empty($_SESSION['resultados_encuesta']['frameworks'])): ?>
                <div style="background: white; padding: 20px; border-radius: 10px; margin: 20px 0;">
                    <h3>🛠️ Frameworks Más Usados</h3>
                    <?php
                    arsort($_SESSION['resultados_encuesta']['frameworks']);
                    $totalFrameworks = array_sum($_SESSION['resultados_encuesta']['frameworks']);
                    foreach ($_SESSION['resultados_encuesta']['frameworks'] as $framework => $votos):
                        $porcentaje = ($votos / $totalFrameworks) * 100;
                    ?>
                        <div class="resultado-item">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span><strong><?php echo htmlspecialchars($frameworksDisponibles[$framework] ?? $framework); ?></strong></span>
                                <span><?php echo $votos; ?> menciones</span>
                            </div>
                            <div class="barra-progreso">
                                <div class="barra-relleno" style="width: <?php echo $porcentaje; ?>%">
                                    <?php echo number_format($porcentaje, 1); ?>%
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" style="text-align: center; margin-top: 20px;">
                <button type="submit" name="reiniciar" class="btn btn-danger">Reiniciar Resultados</button>
            </form>
        <?php else: ?>
            <p style="text-align: center; color: #666; padding: 40px;">
                Aún no hay resultados. ¡Sé el primero en participar! 🎯
            </p>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
