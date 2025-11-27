function esBisiesto() {
    let anio = parseInt(document.getElementById("anio").value);
    let resultado = "";
    if ((anio % 4 === 0 && anio % 100 !== 0) || (anio % 400 === 0)) {
        resultado = `${anio} es un año bisiesto.`;
    } else {
        resultado = `${anio} no es un año bisiesto.`;
    }
    document.getElementById("act7").innerHTML = `<p><strong>${resultado}</strong></p>`;
}