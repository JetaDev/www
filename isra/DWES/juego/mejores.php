<?php
$title = "Mejores Jugadores";
include 'header.php';

$usuario = $_SESSION['usuario_actual'] ?? null;

if (!$usuario) {
    echo '<main><div class="error"><p>Debes iniciar sesión</p></div></main>';
    include 'footer.php';
} else {

$partidas = leerCSV(__DIR__ . '/partidas.csv');
$jugadores = [];

foreach ($partidas as $partida) {
    if (count($partida) < 5) continue;

    $nombre = $partida[1];
    $puntos = (int)$partida[2];
    $preguntas = (int)$partida[3];
    $acertadas = (int)$partida[4];

    if (!isset($jugadores[$nombre])) {
        $jugadores[$nombre] = ['partidas' => 0, 'puntos_totales' => 0, 'preguntas_totales' => 0, 'acertadas_totales' => 0];
    }

    $jugadores[$nombre]['partidas']++;
    $jugadores[$nombre]['puntos_totales'] += $puntos;
    $jugadores[$nombre]['preguntas_totales'] += $preguntas;
    $jugadores[$nombre]['acertadas_totales'] += $acertadas;
}

uasort($jugadores, function($a, $b) {
    return $b['puntos_totales'] - $a['puntos_totales'];
});
?>

<main>
    <h1>🏆 Mejores Jugadores</h1>

    <?php if (empty($jugadores)): ?>
        <div class="error"><p>No hay partidas registradas</p></div>
        <a href="jugar.php" class="btn">🎯 Jugar</a>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Jugador</th>
                    <th>Partidas</th>
                    <th>Puntos</th>
                    <th>Preguntas</th>
                    <th>Acertadas</th>
                    <th>% Acierto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pos = 1;
                foreach ($jugadores as $nombre => $datos):
                    $porcentaje = $datos['preguntas_totales'] > 0 ? round(($datos['acertadas_totales'] / $datos['preguntas_totales']) * 100, 1) : 0;
                    $esActual = ($nombre === $usuario);
                    $medalla = '';
                    if ($pos === 1) $medalla = '🥇';
                    elseif ($pos === 2) $medalla = '🥈';
                    elseif ($pos === 3) $medalla = '🥉';
                ?>
                    <tr <?php if ($esActual) echo 'style="background: #1a3d1a;"'; ?>>
                        <td><?php echo $medalla . ' ' . $pos; ?></td>
                        <td><?php echo htmlspecialchars($nombre); ?> <?php if ($esActual) echo '(Tú)'; ?></td>
                        <td><?php echo $datos['partidas']; ?></td>
                        <td><strong><?php echo $datos['puntos_totales']; ?></strong></td>
                        <td><?php echo $datos['preguntas_totales']; ?></td>
                        <td><?php echo $datos['acertadas_totales']; ?></td>
                        <td><?php echo $porcentaje; ?>%</td>
                    </tr>
                <?php
                    $pos++;
                endforeach;
                ?>
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a href="jugar.php" class="btn">🎯 Jugar</a>
            <a href="index.php" class="btn">🏠 Inicio</a>
        </div>
    <?php endif; ?>
</main>

<?php
}
include 'footer.php';
?>
