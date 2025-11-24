<?php
// HEADER.PHP
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/funciones.php';

// Manejo de login con GET
if (isset($_GET['username']) && isset($_GET['password'])) {
    $user = trim($_GET['username']);
    $pass = trim($_GET['password']);

    if ($user !== '' && $pass !== '') {
        $jugador = buscarJugador($user);

        if ($jugador && $jugador['password'] === $pass) {
            $_SESSION['usuario_actual'] = $user;
            $_SESSION['datos_usuario'] = $jugador;
        } else {
            $_SESSION['error_login'] = 'Usuario o contraseña incorrectos';
        }
    }
}

// Logout con GET
if (isset($_GET['logout'])) {
    unset($_SESSION['usuario_actual']);
    unset($_SESSION['datos_usuario']);
    unset($_SESSION['partida_actual']);
}

$usuario = $_SESSION['usuario_actual'] ?? null;
$datosUsuario = $_SESSION['datos_usuario'] ?? null;
$avatar = $datosUsuario['avatar'] ?? 'default.jpg';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?php echo $title ?? 'Juego de Preguntas'; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="banner">
        <h1>🎮 Juego de Preguntas 🎮</h1>
    </div>

    <header>
        <nav>
            <a href="index.php">🏠 Inicio</a>

            <?php if ($usuario): ?>
                <a href="perfil.php">👤 Perfil</a>

                <?php if ($usuario === 'elchocas'): ?>
                    <a href="editar.php">✏️ Editar Preguntas</a>
                <?php endif; ?>

                <a href="jugar.php">🎯 Jugar</a>
                <a href="mejores.php">🏆 Mejores Jugadores</a>
            <?php else: ?>
                <span class="disabled">👤 Perfil</span>
                <span class="disabled">✏️ Editar Preguntas</span>
                <span class="disabled">🎯 Jugar</span>
                <span class="disabled">🏆 Mejores Jugadores</span>
            <?php endif; ?>
        </nav>

        <aside>
            <?php if (!$usuario): ?>
                <?php if (isset($_SESSION['error_login'])): ?>
                    <p class="error"><?php echo htmlspecialchars($_SESSION['error_login']); ?></p>
                    <?php unset($_SESSION['error_login']); ?>
                <?php endif; ?>

                <form method="get" class="login-form">
                    <div>
                        <label for="username">Usuario:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Iniciar sesión</button>
                </form>
            <?php else: ?>
                <div class="user-info">
                    <img src="img/avatar/<?php echo htmlspecialchars($avatar); ?>" width="50" height="50" alt="Avatar">
                    <div>
                        <strong><?php echo htmlspecialchars($usuario); ?></strong>
                        <?php if ($datosUsuario && !empty($datosUsuario['nombre_completo'])): ?>
                            <br><small><?php echo htmlspecialchars($datosUsuario['nombre_completo']); ?></small>
                        <?php endif; ?>
                    </div>
                    <a href="index.php?logout=1" class="btn-logout">Cerrar sesión</a>
                </div>
            <?php endif; ?>
        </aside>
    </header>
    <hr>
