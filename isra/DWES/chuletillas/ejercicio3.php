<?php
// Ejercicio 3: Login con Sesiones
session_start();

// Usuarios de ejemplo (en un caso real estarían en base de datos)
$usuarios = [
    'admin' => 'admin123',
    'alumno' => 'daw2024',
    'profesor' => 'profe123'
];

$error = null;
$mensaje = null;

// Procesar logout
if (isset($_GET['logout'])) {
    session_destroy();
    $mensaje = "Has cerrado sesión correctamente";
    session_start();
}

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuario !== '' && $password !== '') {
        if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $password) {
            $_SESSION['usuario_logueado'] = $usuario;
            $_SESSION['hora_login'] = date('H:i:s');
            $_SESSION['intentos_fallidos'] = 0;
        } else {
            $error = "Usuario o contraseña incorrectos";
            if (!isset($_SESSION['intentos_fallidos'])) {
                $_SESSION['intentos_fallidos'] = 0;
            }
            $_SESSION['intentos_fallidos']++;
        }
    } else {
        $error = "Por favor, completa todos los campos";
    }
}

$usuarioLogueado = $_SESSION['usuario_logueado'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Login con Sesiones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>👤 Sistema de Login con Sesiones</h1>
        <p class="subtitle">Gestión de usuarios con sesiones en PHP</p>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <?php if ($usuarioLogueado): ?>
            <!-- Usuario logueado -->
            <div class="alert alert-success">
                <h2>✅ Bienvenido, <?php echo htmlspecialchars($usuarioLogueado); ?>!</h2>
                <p>Has iniciado sesión correctamente</p>
            </div>

            <div style="background-color: #f5f5f5; padding: 20px; border-radius: 10px; margin: 20px 0;">
                <h3>📊 Información de la Sesión</h3>
                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuarioLogueado); ?></p>
                <p><strong>Hora de login:</strong> <?php echo htmlspecialchars($_SESSION['hora_login']); ?></p>
                <p><strong>ID de sesión:</strong> <?php echo htmlspecialchars(substr(session_id(), 0, 20)); ?>...</p>
            </div>

            <a href="?logout=1" class="btn btn-danger">Cerrar Sesión</a>

        <?php else: ?>
            <!-- Formulario de login -->
            <form method="POST" action="">
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario"
                           placeholder="Introduce tu usuario" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password"
                           placeholder="Introduce tu contraseña" required>
                </div>

                <button type="submit" name="login" class="btn">Iniciar Sesión</button>
            </form>

            <?php if (isset($_SESSION['intentos_fallidos']) && $_SESSION['intentos_fallidos'] > 0): ?>
                <div class="alert alert-info" style="margin-top: 20px;">
                    ⚠️ Intentos fallidos: <?php echo $_SESSION['intentos_fallidos']; ?>
                </div>
            <?php endif; ?>

            <div style="margin-top: 30px; padding: 20px; background-color: #e3f2fd; border-radius: 10px;">
                <h3>🔑 Usuarios de prueba:</h3>
                <ul>
                    <li><strong>admin</strong> / admin123</li>
                    <li><strong>alumno</strong> / daw2024</li>
                    <li><strong>profesor</strong> / profe123</li>
                </ul>
            </div>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
