<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Simulacro</h1>
    <?php
        $num1 = "7";
        $num2 = (float)4;
        $suma = (int)$num1 + (int)$num2;
        echo "$num1 + $num2 = $suma <br>"; 
        $decimal = 2.5;
        $multi = $suma * $decimal;
        $resto = (int)$multi % 7;
        echo $multi . "<br>";
        echo $resto . "<br>"; 
        $ref = &$suma;
        $ref += 3; 
        echo "$ref = $suma <br>";
        $bool = false;
        var_dump($bool);
        echo "<br>";
        $bool = &$suma;
        var_dump($bool); echo "<br>";
        var_dump((1!=2) && (2 || 0));
    ?>  
</body>
</html>