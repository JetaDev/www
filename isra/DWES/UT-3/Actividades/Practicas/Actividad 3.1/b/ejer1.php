<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $num1 = $_GET['numerouno'];
        $num2 = $_GET['numerodos'];
        $operacion = $_GET['operacion'];
        $resultado = 0;

        switch($operacion){
            case 'suma':
                $resultado = $num1 + $num2;
                break;
            case 'resta':
                $resultado = $num1 - $num2;
                break;
            case 'multiplicacion':
                $resultado = $num1 * $num2;
                break;
            case 'division':
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                } else {
                    $resultado = "Error: no se puede dividir entre cero.";
                }
                break;
            
            default:
                $resultado = "Operacion no valida.";
                break;
        }

        echo "<p><strong>$num1</strong> $operacion <strong>$num2</strong> = <strong>$resultado</strong></p>";
    

    ?>
</body>
</html>