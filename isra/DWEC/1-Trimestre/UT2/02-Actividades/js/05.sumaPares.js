document.writeln("<h3>Ejercicio 5 - Suma Pares en Rango especifico</h3>");

let inicio = parseInt(prompt("Introduce el número inicial del rango:"));
let fin = parseInt(prompt("Introduce el número final del rango:"));
let sumaPares = 0;

for (let i = inicio; i <= fin; i++) {
  if (i % 2 === 0) {
    sumaPares += i;
  }
}

document.writeln(`<p>La suma de los números pares entre ${inicio} y ${fin} es: ${sumaPares}</p>`);
