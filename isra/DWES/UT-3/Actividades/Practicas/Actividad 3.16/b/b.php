<form action="" method="post">
    <label>Introduce texto en castellano:</label><br>
    <textarea name="texto" rows="5" cols="50"></textarea><br><br>
    <button type="submit">Traducir</button>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $texto = trim($_POST["texto"]);

    echo "<h3>Texto original:</h3>";
    echo "<pre>$texto</pre>";

    // Dividir el texto en palabras
    $palabras = explode(" ", $texto);

    $resultado = [];

    foreach ($palabras as $palabra) {

        // Detectar primera letra
        $primera = strtolower($palabra[0]);

        // Si empieza por vocal → añadir ay
        if (in_array($primera, ['a','e','i','o','u'])) {
            $traducida = $palabra . "ay";
        } 
        else {
            // Mover grupo de consonantes iniciales
            preg_match('/^[^aeiou]+/i', $palabra, $grupo);

            if (!empty($grupo[0])) {
                $longitud = strlen($grupo[0]);
                $resto = substr($palabra, $longitud);
                $traducida = $resto . $grupo[0] . "ay";
            } else {
                $traducida = $palabra . "ay";
            }
        }

        $resultado[] = $traducida;
    }

    $texto_traducido = implode(" ", $resultado);

    echo "<h3>Texto traducido a Pig Latin:</h3>";
    echo "<pre>$texto_traducido</pre>";
}
?>
