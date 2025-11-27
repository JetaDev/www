<form action="" method="post">

    <label>Texto:</label><br>
    <textarea name="texto" rows="6" cols="60"></textarea><br><br>

    <label>Buscar:</label>
    <input type="text" name="buscar"><br><br>

    <label>Reemplazar:</label>
    <input type="text" name="reemplazar"><br><br>

    <button type="submit">Enviar</button>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $texto = $_POST["texto"];
    $buscar = trim($_POST["buscar"]);
    $reemplazar = trim($_POST["reemplazar"]);

    echo "<h3>Texto original:</h3>";
    echo "<pre>$texto</pre>";

    // Comprobamos que haya texto a buscar
    if ($buscar !== "") {

        if ($reemplazar !== "") {
            // Caso 1: Buscar + Reemplazar
            $resultado = str_replace($buscar, $reemplazar, $texto);

            echo "<h3>Texto con reemplazos:</h3>";
            echo "<pre>$resultado</pre>";
        } 
        else {
            // Caso 2: Solo buscar → resaltar
            // Usamos mark para sombrear coincidencias
            $resultado = str_replace($buscar, "<mark>$buscar</mark>", $texto);

            echo "<h3>Coincidencias resaltadas:</h3>";
            echo "<pre>$resultado</pre>";
        }

    } else {
        echo "<h3>No se ha indicado texto para buscar.</h3>";
    }

}
?>
