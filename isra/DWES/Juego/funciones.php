<?php
// FUNCIONES.PHP - Funciones auxiliares para el juego

// Leer archivo CSV y devolver array
function leerCSV($archivo) {
    $datos = [];
    if (!file_exists($archivo)) {
        return $datos;
    }

    $handle = fopen($archivo, 'r');
    if ($handle) {
        $primera = true;
        while (($linea = fgetcsv($handle)) !== false) {
            if ($primera) {
                $primera = false;
                // Saltar encabezado si contiene "usuario" o "fecha"
                if (isset($linea[0]) && (strpos($linea[0], 'usuario') !== false || strpos($linea[0], 'fecha') !== false)) {
                    continue;
                }
            }
            $datos[] = $linea;
        }
        fclose($handle);
    }
    return $datos;
}

// Escribir datos en archivo CSV
function escribirCSV($archivo, $datos) {
    $handle = fopen($archivo, 'w');
    if ($handle) {
        foreach ($datos as $linea) {
            fputcsv($handle, $linea);
        }
        fclose($handle);
    }
}

// Leer archivo de texto línea por línea
function leerLineas($archivo) {
    if (!file_exists($archivo)) {
        return [];
    }
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $lineas ? $lineas : [];
}

// Validar teléfono (9 cifras empezando por 6, 7 o 9)
function validarTelefono($telefono) {
    return preg_match('/^[679][0-9]{8}$/', $telefono);
}

// Validar correo (x@y.z)
function validarCorreo($correo) {
    return preg_match('/^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z0-9._]+$/', $correo);
}

// Guardar archivo subido
function guardarArchivo($archivo, $destino) {
    if (!isset($archivo['error']) || $archivo['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (!in_array($archivo['type'], $tiposPermitidos)) {
        return false;
    }

    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombreArchivo = uniqid('avatar_') . '.' . $extension;
    $rutaCompleta = $destino . '/' . $nombreArchivo;

    if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
        return $nombreArchivo;
    }

    return false;
}

// Cargar todas las preguntas
function cargarPreguntas() {
    $archivo = __DIR__ . '/preguntas.txt';
    $lineas = leerLineas($archivo);
    $preguntas = [];

    foreach ($lineas as $linea) {
        $partes = explode('|', $linea);
        if (count($partes) === 6) {
            $preguntas[] = [
                'enunciado' => $partes[0],
                'opciones' => [$partes[1], $partes[2], $partes[3]],
                'correcta' => (int)$partes[4],
                'categoria' => $partes[5]
            ];
        }
    }

    return $preguntas;
}

// Guardar o actualizar pregunta
function guardarPregunta($pregunta, $enunciadoOriginal = null) {
    $archivo = __DIR__ . '/preguntas.txt';
    $lineas = leerLineas($archivo);

    $nuevaLinea = implode('|', [
        $pregunta['enunciado'],
        $pregunta['opciones'][0],
        $pregunta['opciones'][1],
        $pregunta['opciones'][2],
        $pregunta['correcta'],
        $pregunta['categoria']
    ]);

    if ($enunciadoOriginal !== null) {
        // Modificar pregunta existente
        $nuevasLineas = [];
        foreach ($lineas as $linea) {
            $partes = explode('|', $linea);
            if (isset($partes[0]) && $partes[0] === $enunciadoOriginal) {
                $nuevasLineas[] = $nuevaLinea;
            } else {
                $nuevasLineas[] = $linea;
            }
        }
        file_put_contents($archivo, implode("\n", $nuevasLineas) . "\n");
    } else {
        // Añadir nueva pregunta
        file_put_contents($archivo, $nuevaLinea . "\n", FILE_APPEND);
    }
}

// Buscar jugador por nombre de usuario
function buscarJugador($usuario) {
    $archivo = __DIR__ . '/jugadores.csv';
    $jugadores = leerCSV($archivo);

    foreach ($jugadores as $jugador) {
        if (isset($jugador[0]) && $jugador[0] === $usuario) {
            return [
                'usuario' => $jugador[0],
                'password' => $jugador[1] ?? '',
                'nombre_completo' => $jugador[2] ?? '',
                'pais' => $jugador[3] ?? '',
                'telefono' => $jugador[4] ?? '',
                'correo' => $jugador[5] ?? '',
                'avatar' => $jugador[6] ?? 'default.jpg'
            ];
        }
    }

    return null;
}

// Guardar o actualizar jugador
function guardarJugador($datosJugador) {
    $archivo = __DIR__ . '/jugadores.csv';
    $jugadores = leerCSV($archivo);
    $encontrado = false;

    foreach ($jugadores as $i => $jugador) {
        if (isset($jugador[0]) && $jugador[0] === $datosJugador['usuario']) {
            $jugadores[$i] = [
                $datosJugador['usuario'],
                $datosJugador['password'],
                $datosJugador['nombre_completo'],
                $datosJugador['pais'],
                $datosJugador['telefono'],
                $datosJugador['correo'],
                $datosJugador['avatar']
            ];
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $jugadores[] = [
            $datosJugador['usuario'],
            $datosJugador['password'],
            $datosJugador['nombre_completo'],
            $datosJugador['pais'],
            $datosJugador['telefono'],
            $datosJugador['correo'],
            $datosJugador['avatar']
        ];
    }

    escribirCSV($archivo, $jugadores);
}

// Guardar partida finalizada
function guardarPartida($jugador, $puntuacion, $totalPreguntas, $acertadas) {
    $archivo = __DIR__ . '/partidas.csv';
    $fecha = date('Y-m-d H:i:s');

    $handle = fopen($archivo, 'a');
    if ($handle) {
        fputcsv($handle, [$fecha, $jugador, $puntuacion, $totalPreguntas, $acertadas]);
        fclose($handle);
    }
}
?>
