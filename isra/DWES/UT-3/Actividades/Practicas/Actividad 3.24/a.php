<?php 
function juego_dados() : int {
    $petalos = 0;
    for($i=0; $i<5; ++$i) {
        $dado = rand(1, 6);

        // Cálculo de pétalos
        if($dado == 3) { $petalos += 2; }
        else if($dado == 5) { $petalos += 4; }

        // Mostrar imagen (CORREGIDO)
        echo "\t<img src=\"imagenes/dados$dado.png\" width=\"150px\" >\n";
    }
    return $petalos;
}

function imprimir_mensaje(string $nombre, int $prediccion, int $petalos) : void {
    if($prediccion == $petalos) { echo '<br>Enhorabuena, '; }
    else { echo '<br>Oh qué pena, '; }
    echo "$nombre dijo $prediccion pétalos y hay $petalos";
}
?>
<!DOCTYPE html>
<html lang=\"es\">    
    <head>
        <meta charset=\"UTF-8\">
        <title>Pétalos</title>
    </head>
    <body>
<?php 
    $petalos = juego_dados();

    if(isset($_GET['nombre']) && isset($_GET['petalos'])) {
        imprimir_mensaje($_GET['nombre'], $_GET['petalos'], $petalos);
    }

    echo '
        <form method=\"get\">
            <br><label>Nombre:</label>
            <input type=\"text\" name=\"nombre\"';
    if(isset($_GET['nombre'])) { echo " value='{$_GET['nombre']}'"; }
    echo '><br>

            <br><label>Pétalos:</label>
            <input type=\"number\" name=\"petalos\" min=\"0\" max=\"20\"><br>

            <br><input type=\"submit\" value=\"Jugar\">
        </form>
    ';
?>
    </body>
</html>
