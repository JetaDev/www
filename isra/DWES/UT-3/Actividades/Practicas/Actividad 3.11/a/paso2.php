<?php
$cantidad = $_GET['cantidad'];
$funcion  = $_GET['funcion'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducir valores</title>
</head>
<body>

<h1>Introduce los <?php echo $cantidad; ?> valores</h1>

<form action="resultado.php" method="get">

    <!-- Guardamos datos ocultos -->
    <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
    <input type="hidden" name="funcion" value="<?php echo $funcion; ?>">

    <?php
    // Crear tantos campos como dijo el usuario usando un for
    for ($i = 1; $i <= $cantidad; $i++) {
        echo "<label>Valor $i:</label>";
        echo "<input type='number' name='valor$i' required><br><br>";
    }
    ?>

    <button type="submit">Calcular</button>
</form>

</body>
</html>
