<?php

//Hola muy buenas tardes
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nombre = htmlspecialchars($_GET["nombre"]);
    $apellidos = htmlspecialchars($_GET["apellidos"]);
    $mascota = htmlspecialchars($_GET["mascotafavorita"]);
    $aaa = 3242;
}
echo "Me llamo $nombre $apellidos y mi mascota favorita es el $mascota";
