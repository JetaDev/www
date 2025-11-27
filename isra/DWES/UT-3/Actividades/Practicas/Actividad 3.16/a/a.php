<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recogemos la cadena del formulario
    $cadena = $_POST["texto"];

    echo "<h3>Cadena original:</h3>";
    echo "<pre>$cadena</pre>";

    // Limpieza de espacios al principio y final
    $cadena_limpia = trim($cadena);

    // Eliminación de múltiples espacios repetidos
    // (reemplaza 2 o más espacios por 1 solo)
    $cadena_limpia = preg_replace('/\s+/', ' ', $cadena_limpia);

    // Eliminación de caracteres repetidos (por ejemplo !!! → !)
    // Puedes ajustarlo a lo que pida el profesor:
    $cadena_limpia = preg_replace('/(.)\1+/', '$1', $cadena_limpia);

    echo "<h3>Cadena limpia:</h3>";
    echo "<pre>$cadena_limpia</pre>";
}
?>
