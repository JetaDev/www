<?php
// Ejercicio 8: Personalizador de Tema

// Leer preferencias de cookies
$colorPrimario = $_COOKIE['tema_color_primario'] ?? '#667eea';
$colorSecundario = $_COOKIE['tema_color_secundario'] ?? '#764ba2';
$colorFondo = $_COOKIE['tema_color_fondo'] ?? '#ffffff';
$colorTexto = $_COOKIE['tema_color_texto'] ?? '#333333';
$tamanoFuente = $_COOKIE['tema_tamano_fuente'] ?? '16';
$modoOscuro = isset($_COOKIE['tema_modo_oscuro']) && $_COOKIE['tema_modo_oscuro'] === '1';

$mensaje = null;

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar'])) {
        $colorPrimario = $_POST['color_primario'] ?? '#667eea';
        $colorSecundario = $_POST['color_secundario'] ?? '#764ba2';
        $colorFondo = $_POST['color_fondo'] ?? '#ffffff';
        $colorTexto = $_POST['color_texto'] ?? '#333333';
        $tamanoFuente = $_POST['tamano_fuente'] ?? '16';
        $modoOscuro = isset($_POST['modo_oscuro']) ? '1' : '0';

        // Guardar en cookies por 30 días
        $expiracion = time() + (30 * 24 * 60 * 60);
        setcookie('tema_color_primario', $colorPrimario, $expiracion, '/');
        setcookie('tema_color_secundario', $colorSecundario, $expiracion, '/');
        setcookie('tema_color_fondo', $colorFondo, $expiracion, '/');
        setcookie('tema_color_texto', $colorTexto, $expiracion, '/');
        setcookie('tema_tamano_fuente', $tamanoFuente, $expiracion, '/');
        setcookie('tema_modo_oscuro', $modoOscuro, $expiracion, '/');

        $mensaje = "Tema guardado correctamente";
        $modoOscuro = $modoOscuro === '1';
    } elseif (isset($_POST['restablecer'])) {
        // Borrar cookies
        setcookie('tema_color_primario', '', time() - 3600, '/');
        setcookie('tema_color_secundario', '', time() - 3600, '/');
        setcookie('tema_color_fondo', '', time() - 3600, '/');
        setcookie('tema_color_texto', '', time() - 3600, '/');
        setcookie('tema_tamano_fuente', '', time() - 3600, '/');
        setcookie('tema_modo_oscuro', '', time() - 3600, '/');

        // Valores por defecto
        $colorPrimario = '#667eea';
        $colorSecundario = '#764ba2';
        $colorFondo = '#ffffff';
        $colorTexto = '#333333';
        $tamanoFuente = '16';
        $modoOscuro = false;

        $mensaje = "Tema restablecido a valores por defecto";
    } elseif (isset($_POST['tema_preset'])) {
        $preset = $_POST['preset'] ?? '';

        if ($preset === 'oscuro') {
            $colorPrimario = '#bb86fc';
            $colorSecundario = '#03dac6';
            $colorFondo = '#121212';
            $colorTexto = '#ffffff';
            $modoOscuro = true;
        } elseif ($preset === 'naturaleza') {
            $colorPrimario = '#4caf50';
            $colorSecundario = '#8bc34a';
            $colorFondo = '#f1f8e9';
            $colorTexto = '#1b5e20';
            $modoOscuro = false;
        } elseif ($preset === 'oceano') {
            $colorPrimario = '#0288d1';
            $colorSecundario = '#00acc1';
            $colorFondo = '#e1f5fe';
            $colorTexto = '#01579b';
            $modoOscuro = false;
        } elseif ($preset === 'atardecer') {
            $colorPrimario = '#ff6f00';
            $colorSecundario = '#ff5722';
            $colorFondo = '#fff3e0';
            $colorTexto = '#bf360c';
            $modoOscuro = false;
        }

        $expiracion = time() + (30 * 24 * 60 * 60);
        setcookie('tema_color_primario', $colorPrimario, $expiracion, '/');
        setcookie('tema_color_secundario', $colorSecundario, $expiracion, '/');
        setcookie('tema_color_fondo', $colorFondo, $expiracion, '/');
        setcookie('tema_color_texto', $colorTexto, $expiracion, '/');
        setcookie('tema_modo_oscuro', $modoOscuro ? '1' : '0', $expiracion, '/');

        $mensaje = "Tema preset aplicado";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8 - Personalizador de Tema</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, <?php echo $colorPrimario; ?> 0%, <?php echo $colorSecundario; ?> 100%);
            min-height: 100vh;
            padding: 20px;
            font-size: <?php echo $tamanoFuente; ?>px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: <?php echo $colorFondo; ?>;
            color: <?php echo $colorTexto; ?>;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        h1, h2, h3 {
            color: <?php echo $colorTexto; ?>;
        }

        .subtitle {
            text-align: center;
            opacity: 0.7;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input[type="color"],
        .form-group input[type="range"],
        .form-group input[type="checkbox"] {
            cursor: pointer;
        }

        .form-group input[type="color"] {
            width: 100%;
            height: 50px;
            border: 2px solid <?php echo $colorPrimario; ?>;
            border-radius: 8px;
        }

        .form-group input[type="range"] {
            width: 100%;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, <?php echo $colorPrimario; ?> 0%, <?php echo $colorSecundario; ?> 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin: 5px;
            transition: transform 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336 0%, #e91e63 100%);
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: <?php echo $colorPrimario; ?>33;
            border: 2px solid <?php echo $colorPrimario; ?>;
        }

        .preview-box {
            background: linear-gradient(135deg, <?php echo $colorPrimario; ?> 0%, <?php echo $colorSecundario; ?> 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            margin: 20px 0;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .preset-btn {
            padding: 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .preset-btn:hover {
            transform: translateY(-3px);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: <?php echo $colorPrimario; ?>;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">🎨 Personalizador de Tema</h1>
        <p class="subtitle">Personaliza los colores y guárdalos en cookies</p>

        <?php if ($mensaje): ?>
            <div class="alert"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <!-- Vista previa -->
        <div class="preview-box">
            <h2>Vista Previa del Tema</h2>
            <p>Este es un ejemplo de cómo se ve tu tema personalizado</p>
            <p style="font-size: 1.2em;">Tamaño de fuente: <?php echo $tamanoFuente; ?>px</p>
        </div>

        <!-- Temas preset -->
        <h2>🎭 Temas Predefinidos</h2>
        <div class="grid-2" style="margin: 20px 0;">
            <form method="POST" action="">
                <input type="hidden" name="preset" value="oscuro">
                <button type="submit" name="tema_preset" class="preset-btn"
                        style="background: linear-gradient(135deg, #bb86fc 0%, #03dac6 100%); color: white; width: 100%;">
                    🌙 Modo Oscuro
                </button>
            </form>
            <form method="POST" action="">
                <input type="hidden" name="preset" value="naturaleza">
                <button type="submit" name="tema_preset" class="preset-btn"
                        style="background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%); color: white; width: 100%;">
                    🌿 Naturaleza
                </button>
            </form>
            <form method="POST" action="">
                <input type="hidden" name="preset" value="oceano">
                <button type="submit" name="tema_preset" class="preset-btn"
                        style="background: linear-gradient(135deg, #0288d1 0%, #00acc1 100%); color: white; width: 100%;">
                    🌊 Océano
                </button>
            </form>
            <form method="POST" action="">
                <input type="hidden" name="preset" value="atardecer">
                <button type="submit" name="tema_preset" class="preset-btn"
                        style="background: linear-gradient(135deg, #ff6f00 0%, #ff5722 100%); color: white; width: 100%;">
                    🌅 Atardecer
                </button>
            </form>
        </div>

        <!-- Personalización manual -->
        <h2>⚙️ Personalización Manual</h2>
        <form method="POST" action="">
            <div class="grid-2">
                <div class="form-group">
                    <label for="color_primario">Color Primario:</label>
                    <input type="color" id="color_primario" name="color_primario"
                           value="<?php echo htmlspecialchars($colorPrimario); ?>">
                </div>

                <div class="form-group">
                    <label for="color_secundario">Color Secundario:</label>
                    <input type="color" id="color_secundario" name="color_secundario"
                           value="<?php echo htmlspecialchars($colorSecundario); ?>">
                </div>

                <div class="form-group">
                    <label for="color_fondo">Color de Fondo:</label>
                    <input type="color" id="color_fondo" name="color_fondo"
                           value="<?php echo htmlspecialchars($colorFondo); ?>">
                </div>

                <div class="form-group">
                    <label for="color_texto">Color de Texto:</label>
                    <input type="color" id="color_texto" name="color_texto"
                           value="<?php echo htmlspecialchars($colorTexto); ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="tamano_fuente">Tamaño de Fuente: <span id="tamano_valor"><?php echo $tamanoFuente; ?>px</span></label>
                <input type="range" id="tamano_fuente" name="tamano_fuente"
                       min="12" max="24" value="<?php echo $tamanoFuente; ?>"
                       oninput="document.getElementById('tamano_valor').textContent = this.value + 'px'">
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="modo_oscuro" <?php echo $modoOscuro ? 'checked' : ''; ?>>
                    Activar modo oscuro
                </label>
            </div>

            <button type="submit" name="guardar" class="btn">💾 Guardar Tema</button>
            <button type="submit" name="restablecer" class="btn btn-danger">🔄 Restablecer</button>
        </form>

        <!-- Información de cookies -->
        <div style="margin-top: 30px; padding: 20px; background: <?php echo $colorPrimario; ?>22; border-radius: 10px;">
            <h3>🍪 Cookies Guardadas</h3>
            <ul style="margin-top: 10px;">
                <li>Color Primario: <?php echo htmlspecialchars($colorPrimario); ?></li>
                <li>Color Secundario: <?php echo htmlspecialchars($colorSecundario); ?></li>
                <li>Color de Fondo: <?php echo htmlspecialchars($colorFondo); ?></li>
                <li>Color de Texto: <?php echo htmlspecialchars($colorTexto); ?></li>
                <li>Tamaño de Fuente: <?php echo htmlspecialchars($tamanoFuente); ?>px</li>
                <li>Modo Oscuro: <?php echo $modoOscuro ? 'Activado' : 'Desactivado'; ?></li>
            </ul>
        </div>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
