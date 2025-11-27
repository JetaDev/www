let num = parseInt(prompt("Escribe el numero"));
let resultado = 1;

if (num < 0) {
    console.log("No hay factorial de negativos")
}else{
    for (let i = 1; i <= num; i++) {
        resultado *= i;
        
    }
    document.writeln("<h3>Ejercicio 1 Factorial</h3>")
    document.writeln(`El factorial de ${num} es ${resultado}`)
}