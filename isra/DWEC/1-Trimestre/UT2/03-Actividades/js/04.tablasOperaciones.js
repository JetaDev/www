function mostrarTablas() {
    let numero = parseInt(document.getElementById("numAct4").value);
    let resultado = "";

    // Tabla de sumar
    resultado += `<div class="tabla-container">
                    <h3>Tabla de sumar</h3>
                    <table>
                        <tr><th>Operación</th><th>Resultado</th></tr>`;
    for (let i = 1; i <= 10; i++) {
        resultado += `<tr><td>${numero} + ${i}</td><td>${numero + i}</td></tr>`;
    }
    resultado += `</table></div>`;

    // Tabla de multiplicar
    resultado += `<div class="tabla-container">
                    <h3>Tabla de multiplicar</h3>
                    <table>
                        <tr><th>Operación</th><th>Resultado</th></tr>`;
    let i = 1;
    while (i <= 10) {
        resultado += `<tr><td>${numero} * ${i}</td><td>${numero * i}</td></tr>`;
        i++;
    }
    resultado += `</table></div>`;

    // Tabla de dividir
    resultado += `<div class="tabla-container">
                    <h3>Tabla de dividir</h3>
                    <table>
                        <tr><th>Operación</th><th>Resultado</th></tr>`;
    i = 1;
    do {
        resultado += `<tr><td>${numero} / ${i}</td><td>${(numero / i).toFixed(2)}</td></tr>`;
        i++;
    } while (i <= 10);
    resultado += `</table></div>`;

    document.getElementById("act4").innerHTML = resultado;
}
