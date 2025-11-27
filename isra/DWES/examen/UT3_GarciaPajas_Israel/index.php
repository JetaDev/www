<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidad 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-image: url('cards/back.jpg');

            background-position: center;
            background-repeat: repeat;
        }

        h1,
        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
        }

        button {
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .card-display {
            text-align: center;
            margin: 20px 0;
        }

        .card-display img {
            max-width: 200px;
        }

        .score {
            text-align: center;
            padding: 15px;
            background: #f0f0f0;
            margin: 15px 0;
            font-weight: bold;
        }

        .info {
            background: #f9f9f9;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
        }

        .result-message {
            text-align: center;
            padding: 10px;
            margin: 15px 0;
            font-weight: bold;
        }

        .correcto {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .incorrecto {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>
    <?php

        // FUNCIONES


    /**
     * Evalúa si el jugador acertó la predicción
     */
    function evaluarAcierto(string $prediccion, string $cartaReal): bool
    {
        return $prediccion === $cartaReal;
    }

    /**
     * Genera una baraja del palo especificado y la baraja aleatoriamente
     */
    function generarBaraja(string $palo): array
    {
        $valores = ['a', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'j', 'q', 'k'];
        shuffle($valores);
        return $valores;
    }

    /**
     * Obtiene la ruta de la imagen de una carta
     */
    function obtenerImagenCarta(string $carta, string $palo): string
    {
        return "cards/{$palo}/{$carta}.jpg";
    }

    /**
     * Genera el HTML de un desplegable con las opciones de cartas
     */
    function generarDesplegableCartas(array $valores, string $nombre, string $seleccionado = ''): string
    {
        $nombresCartas = [
            'a' => 'As',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
            'j' => 'J',
            'q' => 'Q',
            'k' => 'K'
        ];

        $html = "<select name=\"{$nombre}\" required>";
        $html .= "<option value=\"\">-- Selecciona una carta --</option>";

        foreach ($valores as $valor) {
            $selected = ($valor === $seleccionado) ? ' selected' : '';
            $nombreCarta = $nombresCartas[$valor];
            $html .= "<option value=\"{$valor}\"{$selected}>{$nombreCarta}</option>";
        }

        $html .= "</select>";
        return $html;
    }

    /**
     * Genera el HTML de un desplegable con los palos disponibles
     */
    function generarDesplegablePalos(string $nombre, string $seleccionado = ''): string
    {
        $palos = [
            'hearts' => 'Corazones',
            'diamonds' => 'Diamantes',
            'clubs' => 'Tréboles',
            'spades' => 'Picas'
        ];

        $html = "<select name=\"{$nombre}\" required>";
        $html .= "<option value=\"\">-- Selecciona un palo --</option>";

        foreach ($palos as $valor => $nombre_palo) {
            $selected = ($valor === $seleccionado) ? ' selected' : '';
            $html .= "<option value=\"{$valor}\"{$selected}>{$nombre_palo}</option>";
        }

        $html .= "</select>";
        return $html;
    }


    // LÓGICA PRINCIPAL


    // Obtener parámetros GET
    $accion = $_GET['accion'] ?? 'inicio';
    $nombre = $_GET['nombre'] ?? '';
    $palo = $_GET['palo'] ?? '';
    $puntuacion = isset($_GET['puntuacion']) ? (int)$_GET['puntuacion'] : 0;
    $cartasRestantes = $_GET['cartas'] ?? '';
    $cartaActual = $_GET['carta_actual'] ?? '';
    $prediccion = $_GET['prediccion'] ?? '';


    // ESTADO: INICIO - Formulario inicial

    if ($accion === 'inicio') {
    ?>
        <h1>Adivina la Carta</h1>
        <h2>Baraja Francesa</h2>

        <form method="GET" action="index.php">
            <input type="hidden" name="accion" value="iniciar_juego">

            <div class="form-group">
                <label for="nombre">Tu nombre:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Introduce tu nombre">
            </div>

            <div class="form-group">
                <label for="palo">Selecciona el palo:</label>
                <?php echo generarDesplegablePalos('palo'); ?>
            </div>

            <button type="submit">Comenzar Partida</button>
        </form>
    <?php
    }


    // ESTADO: INICIAR JUEGO - Primera carta

    else if ($accion === 'iniciar_juego') {
        // Generar baraja y sacar primera carta
        $baraja = generarBaraja($palo);
        $cartaActual = array_shift($baraja);
        $cartasRestantes = implode(',', $baraja);

    ?>
        <h1>Adivina la Carta</h1>

        <div class="info">
            <p><strong>Jugador:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Cartas restantes:</strong> <?php echo count($baraja); ?></p>
        </div>

        <div class="score">
            Puntuación: <?php echo $puntuacion; ?> puntos
        </div>

        <div class="card-display">
            <h2>Carta actual:</h2>
            <img src="<?php echo obtenerImagenCarta($cartaActual, $palo); ?>" alt="Carta actual">
        </div>

        <form method="GET" action="index.php">
            <input type="hidden" name="accion" value="adivinar">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <input type="hidden" name="palo" value="<?php echo htmlspecialchars($palo); ?>">
            <input type="hidden" name="puntuacion" value="<?php echo $puntuacion; ?>">
            <input type="hidden" name="cartas" value="<?php echo htmlspecialchars($cartasRestantes); ?>">
            <input type="hidden" name="carta_actual" value="<?php echo htmlspecialchars($cartaActual); ?>">

            <div class="form-group">
                <label for="prediccion">¿Cuál será la siguiente carta?</label>
                <?php
                $barajaArray = explode(',', $cartasRestantes);
                echo generarDesplegableCartas($barajaArray, 'prediccion');
                ?>
            </div>

            <button type="submit">Adivinar</button>
        </form>

        <form method="GET" action="index.php" style="margin-top: 10px;">
            <input type="hidden" name="accion" value="finalizar">
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            <input type="hidden" name="puntuacion" value="<?php echo $puntuacion; ?>">
            <button type="submit" class="button-secondary">Finalizar Partida</button>
        </form>
    <?php
    }

    // ESTADO: ADIVINAR - Procesar predicción
    else if ($accion === 'adivinar') {
        // Convertir cartas restantes a array
        $baraja = explode(',', $cartasRestantes);

        // Sacar la siguiente carta
        $siguienteCarta = array_shift($baraja);

        // Evaluar si acertó
        $acerto = evaluarAcierto($prediccion, $siguienteCarta);

        // Actualizar puntuación
        if ($acerto) {
            $puntuacion += 5;
        }

        // Verificar si quedan cartas
        $hayMasCartas = count($baraja) > 0;

    ?>
        <h1>Adivina la Carta</h1>

        <div class="info">
            <p><strong>Jugador:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Cartas restantes:</strong> <?php echo count($baraja); ?></p>
        </div>

        <div class="score">
            Puntuación: <?php echo $puntuacion; ?> puntos
        </div>

        <div class="result-message <?php echo $acerto ? 'correcto' : 'incorrecto'; ?>">
            <?php
            if ($acerto) {
                echo "¡Correcto! Has ganado 5 puntos";
            } else {
                echo "Fallaste. La carta era diferente";
            }
            ?>
        </div>

        <div class="card-display">
            <h2>La carta era:</h2>
            <img src="<?php echo obtenerImagenCarta($siguienteCarta, $palo); ?>" alt="Carta revelada">
        </div>

        <?php
        if ($hayMasCartas) {
            // Continuar jugando
            $nuevasCartasRestantes = implode(',', $baraja);
        ?>
            <form method="GET" action="index.php">
                <input type="hidden" name="accion" value="adivinar">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                <input type="hidden" name="palo" value="<?php echo htmlspecialchars($palo); ?>">
                <input type="hidden" name="puntuacion" value="<?php echo $puntuacion; ?>">
                <input type="hidden" name="cartas" value="<?php echo htmlspecialchars($nuevasCartasRestantes); ?>">
                <input type="hidden" name="carta_actual" value="<?php echo htmlspecialchars($siguienteCarta); ?>">

                <div class="form-group">
                    <label for="prediccion">¿Cuál será la siguiente carta?</label>
                    <?php echo generarDesplegableCartas($baraja, 'prediccion'); ?>
                </div>

                <button type="submit">Adivinar</button>
            </form>

            <form method="GET" action="index.php" style="margin-top: 10px;">
                <input type="hidden" name="accion" value="finalizar">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                <input type="hidden" name="puntuacion" value="<?php echo $puntuacion; ?>">
                <button type="submit" class="button-secondary">Finalizar Partida</button>
            </form>
        <?php
        } else {
            // No quedan más cartas, fin del juego
        ?>
            <div class="result-message correcto">
                ¡Has completado todas las cartas!
            </div>

            <form method="GET" action="index.php">
                <input type="hidden" name="accion" value="inicio">
                <button type="submit">Nueva Partida</button>
            </form>
        <?php
        }
    }

    // ESTADO: FINALIZAR - Mostrar resultado final
    else if ($accion === 'finalizar') {
        ?>
        <h1>Partida Finalizada</h1>

        <div class="info">
            <p><strong>Jugador:</strong> <?php echo htmlspecialchars($nombre); ?></p>
        </div>

        <div class="score">
            Puntuación Final: <?php echo $puntuacion; ?> puntos
        </div>

        <div class="result-message correcto">
            <?php
            if ($puntuacion >= 40) {
                echo "¡Excelente! Eres un maestro adivinador";
            } else if ($puntuacion >= 20) {
                echo "¡Bien hecho! Buen trabajo";
            } else if ($puntuacion > 0) {
                echo "No está mal";
            } else {
                echo "¡Inténtalo de nuevo!";
            }
            ?>
        </div>

        <form method="GET" action="index.php">
            <input type="hidden" name="accion" value="inicio">
            <button type="submit">Nueva Partida</button>
        </form>
    <?php
    }
    ?>
</body>

</html>
