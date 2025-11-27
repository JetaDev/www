<?php
$cantidad = $_GET['cantidad'];
$funcion  = $_GET['funcion'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Introducir valores</title>
</head>
<body>

<h1>Introduce los <?php echo $cantidad; ?> valores</h1>

<form action="resultado.php" method="get">

    <!-- Guardamos los datos del paso anterior -->
    <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
    <input type="hidden" name="funcion" value="<?php echo $funcion; ?>">

    <?php
    // Crear inputs usando la forma valores[]
    for ($i = 1; $i <= $cantidad; $i++) {
        echo "<label>Valor $i:</label>";
        echo "<input type='number' name='valores[]' required><br><br>";
    }
    ?>

    <button type="submit">Calcular</button>

</form>

</body>
</html>
