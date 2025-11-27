<?php
$title = "Perfil";
include 'header.php';

$usuario = $_SESSION['usuario_actual'] ?? null;

if (!$usuario) {
    echo '<main><div class="error"><p>Debes iniciar sesión para acceder</p></div></main>';
    include 'footer.php';
} else {

$mensaje = '';
$tipoMensaje = '';
$datosUsuario = $_SESSION['datos_usuario'] ?? [];

// Procesar subida de avatar con POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar_upload'])) {
    if ($_FILES['avatar_upload']['error'] === UPLOAD_ERR_OK) {
        $nuevoAvatar = guardarArchivo($_FILES['avatar_upload'], __DIR__ . '/img/avatar');
        if ($nuevoAvatar) {
            $datosUsuario['avatar'] = $nuevoAvatar;
            $_SESSION['datos_usuario']['avatar'] = $nuevoAvatar;
            guardarJugador($datosUsuario);
            $mensaje = "✅ Avatar subido correctamente";
            $tipoMensaje = 'success';
        } else {
            $mensaje = "❌ Error al subir avatar (solo JPG, PNG, GIF)";
            $tipoMensaje = 'error';
        }
    }
}

// Procesar formulario con GET
if (isset($_GET['guardar_perfil'])) {
    $nombreCompleto = trim($_GET['nombre_completo'] ?? '');
    $pais = trim($_GET['pais'] ?? '');
    $telefono = trim($_GET['telefono'] ?? '');
    $correo = trim($_GET['correo'] ?? '');
    $password = trim($_GET['password'] ?? '');
    $avatarActual = $datosUsuario['avatar'] ?? 'default.jpg';

    $errores = [];

    if (empty($nombreCompleto)) $errores[] = "Nombre completo obligatorio";
    if (empty($pais)) $errores[] = "País obligatorio";
    if (empty($telefono)) $errores[] = "Teléfono obligatorio";
    elseif (!validarTelefono($telefono)) $errores[] = "Teléfono: 9 cifras (6XX, 7XX o 9XX)";
    if (empty($correo)) $errores[] = "Correo obligatorio";
    elseif (!validarCorreo($correo)) $errores[] = "Correo formato: x@y.z";
    if (empty($password)) $errores[] = "Contraseña obligatoria";

    if (empty($errores)) {
        $datosGuardar = [
            'usuario' => $usuario,
            'password' => $password,
            'nombre_completo' => $nombreCompleto,
            'pais' => $pais,
            'telefono' => $telefono,
            'correo' => $correo,
            'avatar' => $avatarActual
        ];

        guardarJugador($datosGuardar);
        $_SESSION['datos_usuario'] = $datosGuardar;
        $datosUsuario = $datosGuardar;

        $mensaje = "✅ Perfil guardado correctamente";
        $tipoMensaje = 'success';
    } else {
        $mensaje = "❌ Errores: " . implode(", ", $errores);
        $tipoMensaje = 'error';
    }
}

// Seleccionar avatar con GET
if (isset($_GET['seleccionar_avatar'])) {
    $avatarSeleccionado = basename($_GET['seleccionar_avatar']);
    if (file_exists(__DIR__ . '/img/avatar/' . $avatarSeleccionado)) {
        $datosUsuario['avatar'] = $avatarSeleccionado;
        $_SESSION['datos_usuario']['avatar'] = $avatarSeleccionado;
        guardarJugador($datosUsuario);
        $mensaje = "✅ Avatar actualizado";
        $tipoMensaje = 'success';
    }
}

$paises = leerLineas(__DIR__ . '/paises.txt');
?>

<main>
    <h1>👤 Mi Perfil</h1>

    <?php if ($mensaje): ?>
        <div class="<?php echo $tipoMensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario); ?></p>

    <h2>Avatar Actual</h2>
    <img src="img/avatar/<?php echo htmlspecialchars($datosUsuario['avatar'] ?? 'default.jpg'); ?>"
         width="120" height="120"
         style="border-radius: 12px; border: 3px solid #4CAF50;">

    <h3>Seleccionar Avatar</h3>
    <div class="avatar-selector">
        <?php
        $avatares = scandir(__DIR__ . '/img/avatar');
        foreach ($avatares as $av) {
            if (in_array($av, ['.', '..'])) continue;
            $selected = ($av === ($datosUsuario['avatar'] ?? 'default.jpg')) ? 'selected' : '';
            echo '<a href="perfil.php?seleccionar_avatar=' . urlencode($av) . '">';
            echo '<img src="img/avatar/' . htmlspecialchars($av) . '" class="' . $selected . '">';
            echo '</a>';
        }
        ?>
    </div>

    <h3>Subir Avatar Personalizado</h3>
    <form method="post" enctype="multipart/form-data">
        <label>Selecciona una imagen:</label>
        <input type="file" name="avatar_upload" accept="image/*" required>
        <button type="submit">📤 Subir Avatar</button>
    </form>

    <h2>Datos Personales</h2>
    <form method="get">
        <label>Nombre Completo: *</label>
        <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($datosUsuario['nombre_completo'] ?? ''); ?>" required>

        <label>País: *</label>
        <select name="pais" required>
            <option value="">Selecciona</option>
            <?php foreach ($paises as $p): ?>
                <option value="<?php echo htmlspecialchars($p); ?>" <?php if (($datosUsuario['pais'] ?? '') === $p) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($p); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Teléfono: * (9 cifras: 6XX, 7XX o 9XX)</label>
        <input type="tel" name="telefono" value="<?php echo htmlspecialchars($datosUsuario['telefono'] ?? ''); ?>" required>

        <label>Correo: *</label>
        <input type="email" name="correo" value="<?php echo htmlspecialchars($datosUsuario['correo'] ?? ''); ?>" required>

        <label>Contraseña: *</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($datosUsuario['password'] ?? ''); ?>" required>

        <input type="hidden" name="guardar_perfil" value="1">
        <button type="submit">💾 Guardar</button>
    </form>
</main>

<?php
}
include 'footer.php';
?>
