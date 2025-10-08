function convertirTiempo() {
    //Pasando dias, horas y minutos los convertira a segundos
    let dias = parseInt(document.getElementById("dias").value) || 0;
    let horas = parseInt(document.getElementById("horas").value) || 0;
    let minutos = parseInt(document.getElementById("minutos").value) || 0;
    let totalSegundos = (dias * 86400) + (horas * 3600) + (minutos * 60);
    document.getElementById("act5").innerHTML = `<p><strong>El total en segundos es: ${totalSegundos} segundos</strong></p>`;
}