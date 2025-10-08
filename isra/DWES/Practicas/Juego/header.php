<?php

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="editar.php">Editar</a>
            <a href="jugar.php">Jugar</a>
            <a href="mejores.php">Mejores</a>
            <a href="perfil.php">Perfil</a>
        </nav>
        <aside>
            <form>
                <table>
                    <tr>
                        <td><label for="username">Usuario:</label></td>
                        <td><input type="text" id="username" name="username" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Contraseña:</label></td>
                        <td><input type="password" id="password" name="password" required></td>
                    </tr>
                </table>

                <button type="submit">Iniciar sesión</button>
            </form>
        </aside>

    </header>
