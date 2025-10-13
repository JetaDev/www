<?php
// server.php

// Datos de conexión según tu docker-compose
$db_host = 'mariadb';    // nombre del servicio mariadb
$db_user = 'user';
$db_pass = 'userpass';
$db_name = 'testdb';

$usuario = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'anónimo';

// Generar VIVO/MUERTO aleatorio
$resultado = (mt_rand(0,1) === 1) ? 'VIVO' : 'MUERTO';

// Conectar
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    http_response_code(500);
    echo "Error de conexión a la base de datos: " . $mysqli->connect_error;
    exit;
}

// Insertar resultado
$stmt = $mysqli->prepare("INSERT INTO resultados (usuario, resultado) VALUES (?, ?)");
if (!$stmt) {
    http_response_code(500);
    echo "Error en prepare: " . $mysqli->error;
    exit;
}
$stmt->bind_param('ss', $usuario, $resultado);
if (!$stmt->execute()) {
    http_response_code(500);
    echo "Error al insertar: " . $stmt->error;
    exit;
}
$stmt->close();
$mysqli->close();

// Responder al cliente
echo "El gato está $resultado";
?>