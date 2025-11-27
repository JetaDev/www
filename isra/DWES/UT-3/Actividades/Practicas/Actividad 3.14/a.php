<?php
// ----------------------------------------------
// Inicializamos la matriz donde guardaremos
// los alumnos enviados desde el formulario.
// ----------------------------------------------
$alumnos = [];

// -------------------------------------------------------
// Comprobamos si el formulario ha sido enviado con POST.
// Si es así, recogemos los datos de cada uno de los alumnos.
// -------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recorremos 10 posiciones (10 posibles alumnos)
    for ($i = 0; $i < 10; $i++) {

        // Solo añadimos el alumno si tiene nombre (evita filas vacías)
        if (!empty($_POST["nombre"][$i])) {

            // Guardamos la información del alumno en el array principal
            $alumnos[] = [
                "nombre"    => $_POST["nombre"][$i],
                "apellidos" => $_POST["apellidos"][$i],
                "curso"     => $_POST["curso"][$i],
                "edad"      => $_POST["edad"][$i],
                "localidad" => $_POST["localidad"][$i]
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Actividad 3.14</title>
</head>
<!--a. Crea un formulario para introducir información sobre máximo 10 alumnos de un centro:
nombre, apellidos, curso, edad y localidad.
◦ Ordena a los alumnos en orden alfabético por nombre.
b. Orden a los alumnos en orden alfabético por sus apellidos.
◦ Si hay son iguales los apellidos se utilizará el nombre para desempatar.
c. Usa la función array_multisort para realizar la aplicación anterior ordenando los datos
de forma ascendente.
◦ Utiliza los siguientes criterios: Curso, Apellidos y Nombre.
d. Muestra la información en dos tablas, de principio a fin y de fin a principio, utilizando
funciones de desplazamiento sobre matrices-->
<body>

    <h2>Formulario para introducir hasta 10 alumnos</h2>

    <form method="POST">
        <table border="1" cellpadding="5">

            <!-- Cabecera de la tabla del formulario -->
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Curso</th>
                <th>Edad</th>
                <th>Localidad</th>
            </tr>

            <!-- Generamos 10 filas para introducir datos de alumnos -->
            <?php for ($i = 0; $i < 10; $i++): ?>
                <tr>
                    <td><input type="text" name="nombre[]"></td>
                    <td><input type="text" name="apellidos[]"></td>
                    <td><input type="text" name="curso[]"></td>
                    <td><input type="number" name="edad[]"></td>
                    <td><input type="text" name="localidad[]"></td>
                </tr>
            <?php endfor; ?>

        </table>

        <br>
        <input type="submit" value="Enviar">
    </form>

    <!-- Si el array de alumnos no está vacío, mostramos resultados -->
    <?php if (!empty($alumnos)): ?>

        <hr>

        <!-- a) Ordenar por nombre en orden alfabético -->
        <h2>a) Ordenados alfabéticamente por Nombre</h2>
        <?php
        $ordenNombre = $alumnos;
        sortArrayBy($ordenNombre, "nombre");
        mostrarTabla($ordenNombre);
        ?>

        <!-- b) Ordenar por apellidos y desempatar con el nombre -->
        <h2>b) Ordenados por Apellidos (y Nombre para desempatar)</h2>
        <?php
        $ordenApellidos = $alumnos;
        usort($ordenApellidos, function ($a, $b) {
            // Si los apellidos son iguales, se compara el nombre
            if ($a["apellidos"] == $b["apellidos"]) {
                return strcmp($a["nombre"], $b["nombre"]);
            }
            return strcmp($a["apellidos"], $b["apellidos"]);
        });
        mostrarTabla($ordenApellidos);
        ?>

        <!-- c) Ordenación múltiple usando array_multisort -->
        <h2>c) Orden usando array_multisort (Curso, Apellidos, Nombre)</h2>
        <?php
        $ordenMulti = $alumnos;

        // Extraemos columnas independientes para ordenarlas
        $cursos  = array_column($ordenMulti, "curso");
        $apells  = array_column($ordenMulti, "apellidos");
        $nombres = array_column($ordenMulti, "nombre");

        // Ordenamos según los 3 criterios
        array_multisort($cursos, SORT_ASC, $apells, SORT_ASC, $nombres, SORT_ASC, $ordenMulti);

        mostrarTabla($ordenMulti);
        ?>

        <!-- d) Mostrar tabla normal e invertida -->
        <h2>d) Mostrar de principio a fin y de fin a principio</h2>

        <h3>Tabla de principio a fin</h3>
        <?php mostrarTabla($ordenMulti); ?>

        <h3>Tabla de fin a principio</h3>
        <?php
        // Creamos la versión invertida del array
        $invertido = array_reverse($ordenMulti);
        mostrarTabla($invertido);
        ?>

    <?php endif; ?>


    <?php
    // ---------------------------------------------------------
    // Función para mostrar una tabla HTML con los datos pasados
    // ---------------------------------------------------------
    function mostrarTabla($array)
    {
        echo "<table border='1'>";
        echo "<tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Curso</th>
                <th>Edad</th>
                <th>Localidad</th>
              </tr>";

        // Recorremos todos los alumnos y los mostramos en una fila
        foreach ($array as $alumno) {
            echo "<tr>
                    <td>{$alumno['nombre']}</td>
                    <td>{$alumno['apellidos']}</td>
                    <td>{$alumno['curso']}</td>
                    <td>{$alumno['edad']}</td>
                    <td>{$alumno['localidad']}</td>
                  </tr>";
        }

        echo "</table><br>";
    }

    // ---------------------------------------------------------------------
    // Función auxiliar para ordenar cualquier campo usando strcmp
    // ---------------------------------------------------------------------
    function sortArrayBy(&$array, $key)
    {
        usort($array, function ($a, $b) use ($key) {
            // strcmp devuelve qué cadena va antes alfabéticamente
            return strcmp($a[$key], $b[$key]);
        });
    }
    ?>

</body>

</html>
