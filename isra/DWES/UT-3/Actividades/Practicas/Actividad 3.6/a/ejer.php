<?php
$filas = $_GET['filas'];
$columnas = $_GET['columnas'];
// calcular n
$n = $filas * $columnas;
$contador = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <?php
        for ($i = 1; $i <= $filas; $i++) { // filas
            echo "<tr>";
            for ($i = 1; $i <= $columnas; $i++) { // columnas
                echo "<td> $contador</td>";
                $contador++;
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>