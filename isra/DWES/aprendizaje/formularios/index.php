<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <form action="archivo.php" method="get">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre...">

            <label for="apellidos">Apellidos: </label>
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos...">

            <label for="mascotafavorita">Mascota favorita: </label>
            <select name="mascotafavorita" id="mascotafavorita">
                <option value="nada">Ninguno</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="pajaro">Pájaro</option>
            </select>

            <button type="submit" name="submit">Enviar</button>

        </form>
    </main>
</body>

</html>
