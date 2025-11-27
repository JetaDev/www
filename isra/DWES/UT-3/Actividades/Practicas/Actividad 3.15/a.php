<?php
$numeros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los 5 números del formulario
    for ($i = 0; $i < 5; $i++) {
        if (isset($_POST["num"][$i]) && is_numeric($_POST["num"][$i])) {
            $numeros[] = $_POST["num"][$i];
        }
    }

    // Usamos array_walk para modificar cada número: mitad de su valor
    array_walk($numeros, function (&$valor) {
        $valor = $valor / 2;
    });
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Matriz y array_walk</title>
</head>
<body>

<h2>Introduce 5 números del 1 al 100</h2>

<form method="POST">
    <?php for ($i = 0; $i < 5; $i++): ?>
        <input type="number" name="num[]" min="1" max="100" required>
    <?php endfor; ?>
    <br><br>
    <input type="submit" value="Enviar">
</form>

<?php if (!empty($numeros)): ?>
    <h3>Números divididos entre 2:</h3>
    <ul>
        <?php foreach ($numeros as $n): ?>
            <li><?php echo $n; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>
