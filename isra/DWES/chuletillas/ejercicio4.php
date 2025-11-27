<?php
// Ejercicio 4: Lista de Tareas (CRUD con Sesiones)
session_start();

// Inicializar array de tareas
if (!isset($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [];
}

$mensaje = null;

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $tarea = trim($_POST['tarea'] ?? '');
        $prioridad = $_POST['prioridad'] ?? 'media';

        if ($tarea !== '') {
            $_SESSION['tareas'][] = [
                'id' => uniqid(),
                'texto' => $tarea,
                'prioridad' => $prioridad,
                'completada' => false,
                'fecha' => date('d/m/Y H:i')
            ];
            $mensaje = "Tarea agregada correctamente";
        }
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['id'] ?? '';
        $_SESSION['tareas'] = array_filter($_SESSION['tareas'], function($t) use ($id) {
            return $t['id'] !== $id;
        });
        $_SESSION['tareas'] = array_values($_SESSION['tareas']);
        $mensaje = "Tarea eliminada";
    } elseif (isset($_POST['completar'])) {
        $id = $_POST['id'] ?? '';
        foreach ($_SESSION['tareas'] as &$tarea) {
            if ($tarea['id'] === $id) {
                $tarea['completada'] = !$tarea['completada'];
                break;
            }
        }
        $mensaje = "Estado actualizado";
    } elseif (isset($_POST['limpiar'])) {
        $_SESSION['tareas'] = [];
        $mensaje = "Todas las tareas eliminadas";
    }
}

$prioridades = [
    'alta' => ['nombre' => 'Alta', 'color' => '#ff4444'],
    'media' => ['nombre' => 'Media', 'color' => '#ffaa00'],
    'baja' => ['nombre' => 'Baja', 'color' => '#44ff44']
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Lista de Tareas</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .tarea-item {
            background: white;
            border-left: 5px solid;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        .tarea-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .tarea-completada {
            opacity: 0.6;
            text-decoration: line-through;
        }
        .tarea-info {
            flex-grow: 1;
        }
        .tarea-acciones {
            display: flex;
            gap: 10px;
        }
        .btn-small {
            padding: 8px 15px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Lista de Tareas</h1>
        <p class="subtitle">CRUD completo con sesiones - Crear, Leer, Actualizar, Eliminar</p>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <!-- Formulario para agregar tarea -->
        <form method="POST" action="" style="background: #f5f5f5; padding: 20px; border-radius: 10px;">
            <div class="form-group">
                <label for="tarea">Nueva tarea:</label>
                <input type="text" id="tarea" name="tarea"
                       placeholder="¿Qué necesitas hacer?" required>
            </div>

            <div class="form-group">
                <label for="prioridad">Prioridad:</label>
                <select id="prioridad" name="prioridad">
                    <?php foreach ($prioridades as $key => $valor): ?>
                        <option value="<?php echo $key; ?>">
                            <?php echo htmlspecialchars($valor['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="agregar" class="btn">Agregar Tarea</button>
            <?php if (!empty($_SESSION['tareas'])): ?>
                <button type="submit" name="limpiar" class="btn btn-danger">Limpiar Todo</button>
            <?php endif; ?>
        </form>

        <!-- Estadísticas -->
        <?php
        $total = count($_SESSION['tareas']);
        $completadas = count(array_filter($_SESSION['tareas'], function($t) {
            return $t['completada'];
        }));
        $pendientes = $total - $completadas;
        ?>

        <?php if ($total > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 20px 0;">
                <div style="background: #e3f2fd; padding: 15px; border-radius: 8px; text-align: center;">
                    <h3><?php echo $total; ?></h3>
                    <p>Total</p>
                </div>
                <div style="background: #c8e6c9; padding: 15px; border-radius: 8px; text-align: center;">
                    <h3><?php echo $completadas; ?></h3>
                    <p>Completadas</p>
                </div>
                <div style="background: #fff9c4; padding: 15px; border-radius: 8px; text-align: center;">
                    <h3><?php echo $pendientes; ?></h3>
                    <p>Pendientes</p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Lista de tareas -->
        <h2 style="margin-top: 30px;">Mis Tareas</h2>

        <?php if (empty($_SESSION['tareas'])): ?>
            <p style="text-align: center; color: #666; padding: 40px;">
                No hay tareas. ¡Agrega una para comenzar! 🎯
            </p>
        <?php else: ?>
            <?php foreach ($_SESSION['tareas'] as $tarea): ?>
                <div class="tarea-item <?php echo $tarea['completada'] ? 'tarea-completada' : ''; ?>"
                     style="border-left-color: <?php echo $prioridades[$tarea['prioridad']]['color']; ?>">
                    <div class="tarea-info">
                        <strong><?php echo htmlspecialchars($tarea['texto']); ?></strong>
                        <br>
                        <small style="color: #666;">
                            Prioridad: <?php echo htmlspecialchars($prioridades[$tarea['prioridad']]['nombre']); ?> |
                            Creada: <?php echo htmlspecialchars($tarea['fecha']); ?>
                        </small>
                    </div>
                    <div class="tarea-acciones">
                        <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tarea['id']); ?>">
                            <button type="submit" name="completar" class="btn btn-success btn-small">
                                <?php echo $tarea['completada'] ? '↩️ Reabrir' : '✓ Completar'; ?>
                            </button>
                        </form>
                        <form method="POST" action="" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tarea['id']); ?>">
                            <button type="submit" name="eliminar" class="btn btn-danger btn-small">🗑️ Eliminar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
