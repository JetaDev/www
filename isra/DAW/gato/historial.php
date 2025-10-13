<?php
$db_host = 'mariadb';
$db_user = 'user';
$db_pass = 'userpass';
$db_name = 'testdb';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) { die("Conexión fallida: " . $mysqli->connect_error); }

$res = $mysqli->query("SELECT id, usuario, resultado, fecha FROM resultados ORDER BY fecha DESC");
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Historial</title></head>
<body>
  <h1>Historial de resultados</h1>
  <table border="1" cellpadding="6">
    <tr><th>ID</th><th>Usuario</th><th>Resultado</th><th>Fecha</th></tr>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?=htmlspecialchars($row['id'])?></td>
        <td><?=htmlspecialchars($row['usuario'])?></td>
        <td><?=htmlspecialchars($row['resultado'])?></td>
        <td><?=htmlspecialchars($row['fecha'])?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
<?php $mysqli->close(); ?>
