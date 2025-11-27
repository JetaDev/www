<?php
// Página completa con formulario y validaciones usando expresiones regulares
?>
<!DOCTYPE html>
<html lang="es">
<!--Dada una cadena $cad utiliza expresiones regulares para comprobar si contiene
los siguientes elementos:
a. Un número DNI correcto.
b. Un número de teléfono fijo o móvil.
c. Un nombre de un archivo válido con extensión php, css, html, htm.
d. Una fecha (dd/mm/aaaa ó dd-mm-aaaa).
e. Una dirección IPv4.
f. Una dirección de correo electrónico válida con dominio .com, .org o .es-->
<head>
    <meta charset="UTF-8">
    <title>Validador de elementos</title>
    <style>
        body { font-family: Arial, sans-serif; padding:20px; }
        textarea { width: 100%; height: 120px; }
        .resultado { background:#f2f2f2; padding:10px; margin-top:15px; white-space:pre; }
    </style>
</head>
<body>

<h2>Comprobación de cadena mediante Expresiones Regulares</h2>

<form method="post">
    <label>Introduce una cadena:</label><br>
    <textarea name="cad"></textarea><br><br>
    <button type="submit">Comprobar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $cad = trim($_POST["cad"]);

    $patron_dni      = '/^[0-9]{8}[A-Za-z]$/';
    $patron_telefono = '/^[6798][0-9]{8}$/';
    $patron_archivo  = '/^[A-Za-z0-9._-]+\.(php|css|html|htm)$/i';
    $patron_fecha    = '/^(0?[1-9]|[12][0-9]|3[01])[\/-](0?[1-9]|1[0-2])[\/-][0-9]{4}$/';
    $patron_ip       = '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';
    $patron_email    = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|org|es)$/i';

    echo "<div class='resultado'>";
    echo "Cadena introducida: $cad\n\n";

    echo "DNI: "      . (preg_match($patron_dni, $cad)      ? "Válido" : "No válido") . "\n";
    echo "Teléfono: " . (preg_match($patron_telefono, $cad) ? "Válido" : "No válido") . "\n";
    echo "Archivo: "  . (preg_match($patron_archivo, $cad)  ? "Válido" : "No válido") . "\n";
    echo "Fecha: "    . (preg_match($patron_fecha, $cad)    ? "Válida" : "No válida") . "\n";
    echo "IP: "       . (preg_match($patron_ip, $cad)       ? "Válida" : "No válida") . "\n";
    echo "Email: "    . (preg_match($patron_email, $cad)    ? "Válido" : "No válido") . "\n";

    echo "</div>";
}
?>

</body>
</html>
