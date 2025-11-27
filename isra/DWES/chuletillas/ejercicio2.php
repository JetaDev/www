<?php
// Ejercicio 2: Sistema de Preferencias con Cookies

$mensaje = null;

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar'])) {
        $nombre = $_POST['nombre'] ?? '';
        $color = $_POST['color'] ?? '#667eea';
        $idioma = $_POST['idioma'] ?? 'es';

        // Guardar cookies por 30 días
        $expiracion = time() + (30 * 24 * 60 * 60);
        setcookie('usuario_nombre', $nombre, $expiracion, '/');
        setcookie('usuario_color', $color, $expiracion, '/');
        setcookie('usuario_idioma', $idioma, $expiracion, '/');

        $mensaje = "Preferencias guardadas correctamente";
    } elseif (isset($_POST['borrar'])) {
        // Borrar cookies
        setcookie('usuario_nombre', '', time() - 3600, '/');
        setcookie('usuario_color', '', time() - 3600, '/');
        setcookie('usuario_idioma', '', time() - 3600, '/');

        $mensaje = "Preferencias borradas";
    }
}

// Leer cookies existentes
$nombreGuardado = $_COOKIE['usuario_nombre'] ?? '';
$colorGuardado = $_COOKIE['usuario_color'] ?? '#667eea';
$idiomaGuardado = $_COOKIE['usuario_idioma'] ?? 'es';

$idiomas = [
    'es' => 'Español',
    'en' => 'English',
    'fr' => 'Français',
    'de' => 'Deutsch'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Sistema de Preferencias</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .preview-box {
            background-color: <?php echo htmlspecialchars($colorGuardado); ?>;
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin: 20px 0;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍪 Sistema de Preferencias con Cookies</h1>
        <p class="subtitle">Las preferencias se guardan en tu navegador por 30 días</p>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <?php if ($nombreGuardado): ?>
            <div class="preview-box">
                <h2>¡Hola, <?php echo htmlspecialchars($nombreGuardado); ?>! 👋</h2>
                <p>Tu idioma preferido: <?php echo htmlspecialchars($idiomas[$idiomaGuardado]); ?></p>
                <p>Este es tu color favorito</p>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Tu nombre:</label>
                <input type="text" id="nombre" name="nombre"
                       value="<?php echo htmlspecialchars($nombreGuardado); ?>"
                       placeholder="Introduce tu nombre" required>
            </div>

            <div class="form-group">
                <label for="color">Color favorito:</label>
                <input type="color" id="color" name="color"
                       value="<?php echo htmlspecialchars($colorGuardado); ?>">
            </div>

            <div class="form-group">
                <label for="idioma">Idioma preferido:</label>
                <select id="idioma" name="idioma">
                    <?php foreach ($idiomas as $codigo => $nombre): ?>
                        <option value="<?php echo $codigo; ?>"
                                <?php echo ($idiomaGuardado === $codigo) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($nombre); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="guardar" class="btn">Guardar Preferencias</button>
            <button type="submit" name="borrar" class="btn btn-danger">Borrar Preferencias</button>
        </form>

        <div style="margin-top: 30px; padding: 20px; background-color: #f5f5f5; border-radius: 10px;">
            <h3>ℹ️ Información sobre Cookies</h3>
            <p><strong>Cookies activas:</strong></p>
            <ul>
                <?php if (isset($_COOKIE['usuario_nombre'])): ?>
                    <li>✅ Nombre guardado</li>
                <?php else: ?>
                    <li>❌ Nombre no guardado</li>
                <?php endif; ?>

                <?php if (isset($_COOKIE['usuario_color'])): ?>
                    <li>✅ Color guardado</li>
                <?php else: ?>
                    <li>❌ Color no guardado</li>
                <?php endif; ?>

                <?php if (isset($_COOKIE['usuario_idioma'])): ?>
                    <li>✅ Idioma guardado</li>
                <?php else: ?>
                    <li>❌ Idioma no guardado</li>
                <?php endif; ?>
            </ul>
        </div>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
