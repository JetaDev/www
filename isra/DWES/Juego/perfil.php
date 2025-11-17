<?php
session_start();

// --- PROCESAR CAMBIOS ANTES DE CARGAR HTML ---
// Cambiar nombre: ?nuevo_nombre=NuevoNombre
if (!empty($_GET['nuevo_nombre']) && !empty($_SESSION['usuario_actual'])) {
    $actual = $_SESSION['usuario_actual'];
    $nuevo = trim($_GET['nuevo_nombre']);
    if ($nuevo !== '' && !isset($_SESSION['usuarios'][$nuevo])) {
        // mover datos
        $_SESSION['usuarios'][$nuevo] = $_SESSION['usuarios'][$actual];
        unset($_SESSION['usuarios'][$actual]);
        $_SESSION['usuario_actual'] = $nuevo;
    }
    header("Location: perfil.php"); // redirige para limpiar parámetros
    exit;
}

// Cambiar avatar: ?avatar=avatar2.png
if (!empty($_GET['avatar']) && !empty($_SESSION['usuario_actual'])) {
    $sel = basename($_GET['avatar']); // limpieza básica
    $dir = __DIR__ . '/img/avatar/';
    if (file_exists($dir . $sel)) {
        $_SESSION['usuarios'][$_SESSION['usuario_actual']]['avatar'] = $sel;
    }
    header("Location: perfil.php"); // redirige para reflejar cambio
    exit;
}

// Reset avatar a default: ?accion=reset_avatar
if (!empty($_GET['accion']) && $_GET['accion'] === 'reset_avatar' && !empty($_SESSION['usuario_actual'])) {
    $_SESSION['usuarios'][$_SESSION['usuario_actual']]['avatar'] = 'default.jpg';
    header("Location: perfil.php");
    exit;
}

// --- FIN DE PROCESO, AHORA INCLUIMOS HEADER ---
$title = "Perfil";
include 'header.php';

?>

<main style="padding:20px;">
    <h1>Perfil de <?php echo htmlspecialchars($_SESSION['usuario_actual'] ?? 'Invitado'); ?></h1>

    <?php if (empty($_SESSION['usuario_actual'])): ?>
        <p>Debes iniciar sesión para editar tu perfil.</p>
    <?php else: ?>
        <?php $user = $_SESSION['usuario_actual']; ?>
        <p>Avatar actual:</p>
        <img src="img/avatar/<?php echo htmlspecialchars($_SESSION['usuarios'][$user]['avatar']); ?>" width="120" height="120" style="border-radius:12px; object-fit:cover; border:1px solid #ccc;">

        <p><a href="perfil.php?accion=reset_avatar">Usar avatar predeterminado</a></p>

        <h3>Elegir avatar</h3>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <?php
            $avatars = scandir(__DIR__ . '/img/avatar');
            foreach ($avatars as $a) {
                if (in_array($a, ['.', '..'])) continue;
                echo '<a href="perfil.php?avatar=' . urlencode($a) . '">';
                echo '<img src="img/avatar/' . htmlspecialchars($a) . '" width="80" height="80" style="border-radius:8px; object-fit:cover; border:' . ($a === $_SESSION['usuarios'][$user]['avatar'] ? '3px solid green' : '1px solid #ccc') . ';">';
                echo '</a>';
            }
            ?>
        </div>

        <h3>Cambiar nombre</h3>
        <form method="get">
            <input type="text" name="nuevo_nombre" placeholder="Nuevo nombre" required>
            <button type="submit">Cambiar nombre</button>
        </form>
        <p>* Si el nombre ya existe, no se cambiará.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
