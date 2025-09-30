document.writeln("<h3>Ejercicio 3 - Números impares del 100 al 1 con FOR</h3>");

for (let i = 100; i >= 1; i--) {
    if (i % 2 !== 0 && i % 3 !== 0 && i % 7 !== 0) {
        document.writeln(i + " ");
    }
}

document.writeln("<h3>Ejercicio 3 - Números impares del 100 al 1 con WHILE</h3>");

let contador = 100;
while (contador > 0) {
    if (contador % 2 !== 0 && contador % 3 !== 0 && contador % 7 !== 0) {
        document.writeln(contador + " ");
    }
    contador--;
}

document.writeln("<h3>Ejercicio 3 - Números impares del 100 al 1 con DO</h3>");


let contadorDo = 100;

do {
        if (contadorDo % 2 !== 0 && contadorDo % 3 !== 0 && contadorDo % 7 !== 0) {
        document.writeln(contadorDo + " ");
    }
    contadorDo--
} while (contadorDo > 0);