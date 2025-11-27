<?php 
    $phtml = ''; //variable que almacenará el contenido html dinámico
    $deck = [1, 2, 3]; //array que presenta las cartas
    shuffle($deck); // Mezcla aleatoriamente el array para ocultar la posición de la carta ganadora


//Si el usuario ha pulsado "Barajar" o ha intentado "Comprobar" sin seleccionar una carta,
//Se muestra el formulario con las cartas ocultas.
if(((isset($_GET['action'])) && ($_GET['action'] == 'Barajar')) ||
((isset($_GET['action'])) && ($_GET['action'] == 'Comprobar') && (!isset($_GET['seleccionada'])))) {

    //Se muestran las cartas boca abajo y tres botones de selección para elegir una carta.
    //Al enviar el formulario, se activa la acción "Comprobar".
    $phtml = '
    <form method = "get">
        <table>
            <tr>
                <td><img src="imagenes/back.png" width="200px" ></td>
                <td><img src="imagenes/back.png" width="200px" ></td>
                <td><img src="imagenes/back.png" width="200px" ></td>
            </tr>
            <tr>
                <td><input type="radio" name="seleccionada" value="0"></td>
                <td><input type="radio" name="seleccionada" value="1"></td>
                <td><input type="radio" name="seleccionada" value="2"></td>
            </tr>
        </table>
        <input type="submit" name="action" value="Comprobar">
    </form>
    ';
    //Si no se cumple la condición anterior: mostrar cartas descubiertas.
} else {
    $phtml = '
    <form method="get">
        <table>
            <tr>
                <td><img src="imagenes/spades.png'.$deck[0].'.png" width="200px" ></td>
                <td><img src="imagenes/spades1.png'.$deck[1].'.png" width="200px" ></td>
                <td><img src="imagenes/spades2.png'.$deck[2].'.png" width="200px" ></td>
            </tr>
        </table>
        <input type="submit" name="action" value="Barajar">
    </form>
    ';
    //Comprobación del resultado.
    //Si el usuario ha pulsado "Comprobar" y ha selecionado una carta:
        //Se compara el valor de la carta seleccionada con 1 (carta ganadora).
        //Se muestra el mensaje correspondiente: "Has ganado" o "Has perdido".

    if((isset($_GET['action'])) && ($_GET['action'] == 'Comprobar') && (isset($_GET['seleccionada']))) {
        if($deck[$_GET['seleccionada']] == 1) {
            $phtml .= '<h1>Has ganado</h1>';
        } else {
            $phtml .= '<h3>Has perdido</h3>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Trileros</title>
        <style>td{text-align: center; }</style>
    </head>
    <body>
        <?= $phtml?>
    </body>
</html>