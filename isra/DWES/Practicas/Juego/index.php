<?php
$title = "Index";
include 'header.php';
?>

<h1>Bienvenido a mi increíble página</h1>

<h3>Si quieres que mi página siga creciendo rellena lo de abajo</h3>
<img src="img/pulgarArriba.jpeg" alt="pulgar arriba" width="75">
<form action="#" method="post">
  <label for="nombre">Nombre:</label><br>
  <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required><br><br>

  <label for="cuenta">Cuenta bancaria:</label><br>
  <input type="text" id="cuenta" name="cuenta" placeholder="Número de cuenta"><br><br><br>

  <button type="submit">Enviar</button>
</form>

<?php
include 'footer.php';
?>
