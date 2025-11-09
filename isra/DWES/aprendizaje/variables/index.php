<?php

//Primitivos
$string = "Israel García";
$int = 12131;
$floar = 1.3423;
$bool = true;

//Array
$nombres = ['Daniel','Samuel','Israel'];

// Objeto
//$objeto = new Car();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables</title>
</head>
<body>
    <?php echo $nombres ?>
    <p>Mi nombre es <?=$string?></p>
</body>
</html>