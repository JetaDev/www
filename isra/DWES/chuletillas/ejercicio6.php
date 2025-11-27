<?php
// Ejercicio 6: Carrito de Compras
session_start();

// Recordar nombre de usuario con cookie
if (!isset($_COOKIE['nombre_cliente']) && isset($_POST['guardar_nombre'])) {
    $nombre = trim($_POST['nombre_cliente'] ?? '');
    if ($nombre !== '') {
        setcookie('nombre_cliente', $nombre, time() + (30 * 24 * 60 * 60), '/');
        $_COOKIE['nombre_cliente'] = $nombre;
    }
}

// Inicializar carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Productos disponibles
$productos = [
    'laptop' => ['nombre' => 'Laptop HP', 'precio' => 599.99],
    'mouse' => ['nombre' => 'Mouse Logitech', 'precio' => 29.99],
    'teclado' => ['nombre' => 'Teclado Mecánico', 'precio' => 89.99],
    'monitor' => ['nombre' => 'Monitor 24"', 'precio' => 199.99],
    'auriculares' => ['nombre' => 'Auriculares Sony', 'precio' => 79.99],
    'webcam' => ['nombre' => 'Webcam HD', 'precio' => 49.99]
];

$mensaje = null;

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $producto_id = $_POST['producto'] ?? '';
        $cantidad = intval($_POST['cantidad'] ?? 1);

        if (isset($productos[$producto_id]) && $cantidad > 0) {
            if (isset($_SESSION['carrito'][$producto_id])) {
                $_SESSION['carrito'][$producto_id] += $cantidad;
            } else {
                $_SESSION['carrito'][$producto_id] = $cantidad;
            }
            $mensaje = "Producto agregado al carrito";
        }
    } elseif (isset($_POST['eliminar'])) {
        $producto_id = $_POST['producto_id'] ?? '';
        if (isset($_SESSION['carrito'][$producto_id])) {
            unset($_SESSION['carrito'][$producto_id]);
            $mensaje = "Producto eliminado del carrito";
        }
    } elseif (isset($_POST['vaciar'])) {
        $_SESSION['carrito'] = [];
        $mensaje = "Carrito vaciado";
    } elseif (isset($_POST['actualizar'])) {
        $producto_id = $_POST['producto_id'] ?? '';
        $cantidad = intval($_POST['cantidad'] ?? 0);

        if (isset($_SESSION['carrito'][$producto_id])) {
            if ($cantidad > 0) {
                $_SESSION['carrito'][$producto_id] = $cantidad;
                $mensaje = "Cantidad actualizada";
            } else {
                unset($_SESSION['carrito'][$producto_id]);
                $mensaje = "Producto eliminado";
            }
        }
    }
}

// Calcular total
$total = 0;
foreach ($_SESSION['carrito'] as $id => $cantidad) {
    if (isset($productos[$id])) {
        $total += $productos[$id]['precio'] * $cantidad;
    }
}

$nombreCliente = $_COOKIE['nombre_cliente'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Carrito de Compras</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .productos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .producto-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .precio {
            font-size: 1.5em;
            color: #667eea;
            font-weight: bold;
            margin: 10px 0;
        }
        .carrito-item {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛒 Carrito de Compras</h1>
        <p class="subtitle">Sesiones para el carrito + Cookies para recordar usuario</p>

        <?php if ($nombreCliente): ?>
            <div class="alert alert-info">
                👋 Hola, <strong><?php echo htmlspecialchars($nombreCliente); ?></strong>!
                (guardado en cookie)
            </div>
        <?php else: ?>
            <form method="POST" action="" style="background: #e3f2fd; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <div style="display: flex; gap: 10px; align-items: end;">
                    <div class="form-group" style="flex-grow: 1; margin: 0;">
                        <label for="nombre_cliente">¿Cómo te llamas?</label>
                        <input type="text" id="nombre_cliente" name="nombre_cliente"
                               placeholder="Tu nombre" required>
                    </div>
                    <button type="submit" name="guardar_nombre" class="btn">Guardar</button>
                </div>
            </form>
        <?php endif; ?>

        <?php if ($mensaje): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <h2>📦 Productos Disponibles</h2>
        <div class="productos-grid">
            <?php foreach ($productos as $id => $producto): ?>
                <div class="producto-card">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <div class="precio">€<?php echo number_format($producto['precio'], 2); ?></div>
                    <form method="POST" action="">
                        <input type="hidden" name="producto" value="<?php echo htmlspecialchars($id); ?>">
                        <div class="form-group">
                            <input type="number" name="cantidad" value="1" min="1" max="99"
                                   style="width: 80px; text-align: center;">
                        </div>
                        <button type="submit" name="agregar" class="btn">Agregar al Carrito</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 style="margin-top: 40px;">🛍️ Mi Carrito</h2>

        <?php if (empty($_SESSION['carrito'])): ?>
            <p style="text-align: center; color: #666; padding: 40px;">
                Tu carrito está vacío. ¡Agrega algunos productos! 🛒
            </p>
        <?php else: ?>
            <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
                <?php if (isset($productos[$id])): ?>
                    <div class="carrito-item">
                        <div>
                            <strong><?php echo htmlspecialchars($productos[$id]['nombre']); ?></strong>
                            <br>
                            <small>€<?php echo number_format($productos[$id]['precio'], 2); ?> × <?php echo $cantidad; ?> =
                                €<?php echo number_format($productos[$id]['precio'] * $cantidad, 2); ?>
                            </small>
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($id); ?>">
                                <input type="number" name="cantidad" value="<?php echo $cantidad; ?>"
                                       min="0" max="99" style="width: 60px;">
                                <button type="submit" name="actualizar" class="btn btn-small">✓</button>
                            </form>
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="producto_id" value="<?php echo htmlspecialchars($id); ?>">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-small">🗑️</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <div style="background: #c8e6c9; padding: 20px; border-radius: 10px; margin-top: 20px; text-align: center;">
                <h2>Total: €<?php echo number_format($total, 2); ?></h2>
                <p><?php echo count($_SESSION['carrito']); ?> productos en el carrito</p>
            </div>

            <form method="POST" action="" style="margin-top: 20px; text-align: center;">
                <button type="submit" name="vaciar" class="btn btn-danger">Vaciar Carrito</button>
                <button type="button" class="btn btn-success"
                        onclick="alert('¡Compra realizada! (simulación)')">
                    💳 Proceder al Pago
                </button>
            </form>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Volver al índice</a>
    </div>
</body>
</html>
