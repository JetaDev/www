<!--Analiza el siguiente código y describe cual sería la salida por pantalla. Compruébalo ejecutando el
código en el servidor.
a) -->
<?php
$resultado = 0.00;
$tipo = gettype($resultado);
echo "<p>Resultado vale: $resultado y es de tipo $tipo<br>";
$resultado = "Cero";
$tipo = gettype($resultado);
echo "y ahora vale: $resultado y es de tipo $tipo</p><br>";
?>
<!--  
b) -->
<?php
$resultado = 0;
$tipo = gettype($resultado);
echo "<p>Resultado vale: $resultado y es de tipo $tipo<br>";
$resultado2 = (double)$resultado;
$tipo = gettype($resultado2);
echo "y Resultado2: $resultado2 y es de tipo $tipo<br>";
$tipo = gettype($resultado);
echo "y Resultado vale: $resultado y es de tipo $tipo</p><br>";
?>