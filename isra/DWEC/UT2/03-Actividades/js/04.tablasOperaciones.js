function mostrarTablas(){
    //Hacer la tabla de sumar, dividir y multiplicar, cada una con un bucle distinto
    let numero = document.getElementById("numAct4").value;
    let resultado = "<h3>Tabla de sumar</h3>";
    for (let i = 1; i <= 10; i++) {
        resultado += `${numero} + ${i} = ${parseInt(numero) + i} <br>`;
    }
    resultado += "<h3>Tabla de multiplicar</h3>";
    let i = 1;
    while (i <= 10) {
        resultado += `${numero} * ${i} = ${parseInt(numero) * i} <br>`;
        i++;
    }
    resultado += "<h3>Tabla de dividir</h3>";
    i = 1;
    do {
        resultado += `${numero} / ${i} = ${(parseInt(numero) / i).toFixed(2)} <br>`;
        i++;
    } while (i <= 10);

    document.getElementById("act4").innerHTML = resultado;
}