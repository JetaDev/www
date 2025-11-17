resultado1 = document.getElementById("resultado1");
resultado2 = document.getElementById("resultado2");
resultado3 = document.getElementById("resultado3");
resultado4 = document.getElementById("resultado4");
resultado5 = document.getElementById("resultado5");


const naturalRecursividad = (n) => {
    if (n <= 0) {
        return 0;
    } else {
        return n + naturalRecursividad(n - 1);
    }
};

const potenciaRecursividad = (base, exponente) => {
    if (exponente === 0) {
        return 1;
    } else {
        return base * potenciaRecursividad(base, exponente - 1);
    }
}

const invertirCadenaRecursividad = (cadena) => {
    if (cadena === "") {
        return "";
    } else {
        return cadena.charAt(cadena.length - 1) + invertirCadenaRecursividad(cadena.slice(0, -1));
    }
}
const palindromoRecursividad = (cadena) => {
    cadena = cadena.toLowerCase();
    if (cadena.length <= 1) {
        return true;
    } else if (cadena.charAt(0) !== cadena.charAt(cadena.length - 1)) {
        return false;
    } else {
        return palindromoRecursividad(cadena.slice(1, -1));
    }
}

const fibonacciRecursividad = (n) => {
    if (n <= 0) {
        return 0;
    } else if (n === 1) {
        return 1;
    } else {
        return fibonacciRecursividad(n - 1) + fibonacciRecursividad(n - 2);
    }
}

const mostrarNatural = () => {
    let numero = parseInt(document.getElementById("numero1").value);
    let resultado = naturalRecursividad(numero);
    resultado1.innerHTML = `La suma de los números naturales hasta ${numero} es: ${resultado}`;
}

const mostrarPotencia = () => {
    let base = parseInt(document.getElementById("base").value);
    let exponente = parseInt(document.getElementById("exponente").value);
    let resultado = potenciaRecursividad(base, exponente);

    resultado2.innerHTML = `El resultado de ${base} elevado a ${exponente} es: ${resultado}`;
}

const mostrarCadena = () => {
    let cadena = document.getElementById("cadena").value;
    let resultado = invertirCadenaRecursividad(cadena);
    resultado3.innerHTML = `La cadena invertida es: ${resultado}`;
}

const esPalindromo = () => {
    let cadena = document.getElementById("palindromo").value;
    let resultado = palindromoRecursividad(cadena);
    if (resultado) {
        resultado4.innerHTML = `La cadena "${cadena}" es un palíndromo.`;
    } else {
        resultado4.innerHTML = `La cadena "${cadena}" no es un palíndromo.`;
    }
}

const mostrarFibonacci = () => {
    let numero = parseInt(document.getElementById("numeroFibo").value);
    let resultado = fibonacciRecursividad(numero);
    document.getElementById("resultado5").innerHTML = `El número Fibonacci en la posición ${numero} es: ${resultado}`;
}
resultado4 = document.getElementById("resultado4");
