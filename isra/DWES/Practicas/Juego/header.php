<?php
// HEADER.PHP
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inicializar array de usuarios si no existe
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [
        'admin' => ['password' => '1234', 'avatar' => 'default.png']
    ];
}

// Manejo de login / registro por GET
if (isset($_GET['username']) && isset($_GET['password'])) {
    $user = trim($_GET['username']);
    $pass = trim($_GET['password']);

    // Si ya existe, comprobamos contraseña, si no, se registra
    if (isset($_SESSION['usuarios'][$user])) {
        $_SESSION['usuario_actual'] = $user;
    } else {
        $_SESSION['usuarios'][$user] = ['password' => $pass, 'avatar' => 'default.jpg'];
        $_SESSION['usuario_actual'] = $user;
    }

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// Logout
if (isset($_GET['logout'])) {
    unset($_SESSION['usuario_actual']);
    header("Location: index.php");
    exit;
}

// Variables para mostrar
$usuario = $_SESSION['usuario_actual'] ?? null;
$avatar = $usuario ? ($_SESSION['usuarios'][$usuario]['avatar'] ?? 'default.png') : 'default.png';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?php echo $title ?? 'Juego'; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header style="padding:10px; background:#eee; display:flex; justify-content:space-between; align-items:center;">
        <nav>
            <a href="index.php">Inicio</a>
            <a href="editar.php">Editar</a>
            <a href="jugar.php">Jugar</a>
            <a href="mejores.php">Mejores</a>
            <a href="perfil.php">Perfil</a>

            <?php
            // Mostrar secret.php solo si usuario "isra" con contraseña "123"
            if ($usuario && $usuario === 'isra' && ($_SESSION['usuarios'][$usuario]['password'] ?? '') === '123') {
                echo '<a href="secret.php">Secret</a>';
            }
            ?>
        </nav>

        <aside>
            <?php if (!$usuario): ?>
                <form method="get">
                    <table>
                        <tr>
                            <td><label for="username">Usuario:</label></td>
                            <td><input type="text" id="username" name="username" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Contraseña:</label></td>
                            <td><input type="text" id="password" name="password" required></td>
                        </tr>
                    </table>
                    <button type="submit">Iniciar sesión / Registrarse</button>
                </form>
            <?php else: ?>
                <div style="display:flex; align-items:center; gap:10px;">
                    <img src="img/avatar/<?php echo htmlspecialchars($avatar); ?>" width="40" height="40" style="border-radius:6px; object-fit:cover;">
                    <span>Hola, <strong><?php echo htmlspecialchars($usuario); ?></strong></span>
                    <a href="?logout=1">Cerrar sesión</a>
                </div>
            <?php endif; ?>
        </aside>
    </header>
    <hr>
