<?php 
// Comprobamos si llegan datos correctos
if (!isset($_GET['nombre']) || !isset($_GET['apellido']) ||
    $_GET['nombre'] == "" || $_GET['apellido'] == "") {

    echo "<h1>Faltan datos</h1>";
    echo "<p>Debes rellenar nombre y apellido.</p>";
    echo '<a href="a.html">Volver al formulario</a>';
    exit();
}

$nombre =$_GET['nombre'];
$apellido=$_GET['apellido'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>bienvienido, <?php echo $nombre . "" . $apellido; ?></h1>
</body>
</html>
