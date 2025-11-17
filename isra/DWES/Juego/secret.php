<?php
// secret.php - acceso libre, solo ver usuarios y borrarlos
session_start();

// Inicializar array si no existe
if (!isset($_SESSION['usuarios']) || !is_array($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}

// Borrar usuario: ?delete=usuario
if (isset($_GET['delete'])) {
    $d = $_GET['delete'];
    if (isset($_SESSION['usuarios'][$d])) {
        unset($_SESSION['usuarios'][$d]);
    }
    // redirigir para limpiar la URL
    header('Location: secret.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Secret - Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        img.avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
        }

        a.btn {
            padding: 4px 8px;
            background: #e05a4f;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Usuarios registrados</h1>
    <p>Acceso libre. Solo puedes ver y borrar usuarios.</p>

    <?php if (empty($_SESSION['usuarios'])): ?>
        <p>No hay usuarios.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Avatar</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['usuarios'] as $name => $data):
                    $avatar = $data['avatar'] ?? 'default.png';
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($name); ?></td>
                        <td>
                            <?php if (file_exists(__DIR__ . '/img/avatar/' . $avatar)): ?>
                                <img class="avatar" src="img/avatar/<?php echo htmlspecialchars($avatar); ?>" alt="avatar">
                            <?php else: ?>
                                <?php echo htmlspecialchars($avatar); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn" href="secret.php?delete=<?php echo urlencode($name); ?>" onclick="return confirm('Borrar <?php echo htmlspecialchars($name); ?>?')">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p><a href="index.php">Volver al sitio</a></p>
</body>

</html>
