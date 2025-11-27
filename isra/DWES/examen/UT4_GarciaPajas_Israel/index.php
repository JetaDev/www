<?php
// Función para leer el archivo CSV
function leerCSV(string $archivo): array
{
    $datos = [];

    if (file_exists($archivo)) {
        $contenido = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($contenido as $linea) {
            $campos = explode(',', $linea);
            if (count($campos) === 2) {
                $datos[$campos[0]] = (int)$campos[1];
            }
        }
    }

    return $datos;
}

// Función para escribir en el archivo CSV
function escribirCSV(string $archivo, array $datos): bool
{
    $contenido = '';

    foreach ($datos as $pagina => $visitas) {
        $contenido .= $pagina . ',' . $visitas . "\n";
    }

    $resultado = file_put_contents($archivo, $contenido);

    return $resultado !== false;
}

// Función para actualizar las visitas de una página
function actualizarVisitas(array &$datos, string $pagina): void
{
    if (array_key_exists($pagina, $datos)) {
        $datos[$pagina]++;
    } else {
        $datos[$pagina] = 1;
    }
}

// Configuración
$archivoCSV = 'visitas.csv';
$paginaActual = 'Inicio'; // Página por defecto

// Obtener la página actual desde el parámetro GET
if (isset($_GET['pag']) && $_GET['pag'] !== '') {
    $paginaActual = $_GET['pag'];
}

// Leer datos del CSV
$datos = leerCSV($archivoCSV);

// Actualizar contador de visitas
actualizarVisitas($datos, $paginaActual);

// Guardar datos actualizados en el CSV
escribirCSV($archivoCSV, $datos);

// Obtener la última visita desde la cookie
$ultimaVisita = null;
if (isset($_COOKIE['ultima_visita'])) {
    $ultimaVisita = $_COOKIE['ultima_visita'];
}

// Establecer la cookie con la página actual
$expiracion = time() + (30 * 24 * 60 * 60);
setcookie('ultima_visita', $paginaActual, $expiracion, '/');

// Obtener el número de visitas de la página actual
$visitasActuales = $datos[$paginaActual];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidad 4</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 40px;
            background-image: url(../UT3/cards/joker1.jpg);
        }

        .container {
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border: 2px solid #000;

        }

        h1 {
            font-size: 32px;
            margin: 0 0 20px 0;
            font-weight: bold;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin: 10px 0;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            margin: 25px 0 10px 0;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        li {
            margin: 8px 0;
        }

        a {
            color: #0000EE;
            text-decoration: underline;
            font-size: 18px;
        }

        a:visited {
            color: #551A8B;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Página: <?php echo htmlspecialchars($paginaActual); ?></h1>

        <p>Visitas totales: <?php echo $visitasActuales; ?></p>

        <?php if ($ultimaVisita !== null): ?>
            <p>Tu última visita registrada fue a: <?php echo htmlspecialchars($ultimaVisita); ?></p>
        <?php else: ?>
            <p>No hay registro de tu última visita (cookie no encontrada)</p>
        <?php endif; ?>

        <h2>Páginas de ejemplo:</h2>
        <ul>
            <li><a href="index.php?pag=Inicio">Inicio</a></li>
            <li><a href="index.php?pag=Contacto">Contacto</a></li>
            <li><a href="index.php?pag=Blog">Blog</a></li>
        </ul>
    </div>

</body>

</html>
