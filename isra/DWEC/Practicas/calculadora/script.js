// Añadir texto a la pantalla
function agregar(valor) {
    document.getElementById('pantalla').value += valor;

    // Mueve automáticamente el scroll al final
    pantalla.scrollLeft = pantalla.scrollWidth;
}

// Borrar todo
function limpiar() {
    document.getElementById('pantalla').value = '';
}

// Calcular el resultado de operaciones básicas
function calcular() {
    try {
        let expresion = document.getElementById('pantalla').value;
        let resultado = eval(expresion);
        document.getElementById('pantalla').value = parseFloat(resultado.toFixed(2));
    } catch (error) {
        document.getElementById('pantalla').value = 'Error';
    }
}

// Funciones científicas
function funcion(tipo) {
    let pantalla = document.getElementById('pantalla');
    let valor = parseFloat(pantalla.value);

    if (isNaN(valor)) {
        pantalla.value = 'Error';
        return;
    }

    let resultado = 0;

    // Convertir a radianes para las funciones trigonométricas
    if (tipo === 'sin') resultado = Math.sin(valor * Math.PI / 180);
    else if (tipo === 'cos') resultado = Math.cos(valor * Math.PI / 180);
    else if (tipo === 'tan') resultado = Math.tan(valor * Math.PI / 180);
    else if (tipo === 'log') resultado = Math.log10(valor);
    else if (tipo === 'sqrt') resultado = Math.sqrt(valor);
    else if (tipo === 'exp') resultado = Math.exp(valor);
    else if (tipo === 'pow') {
        let exponente = prompt("Introduce el exponente:");
        resultado = Math.pow(valor, parseFloat(exponente));
    }

    pantalla.value = parseFloat(resultado.toFixed(2)); // máximo 2 decimales
}
