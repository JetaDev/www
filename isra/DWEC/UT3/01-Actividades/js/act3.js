
function diasFinCurso() {

    let finCurso = new Date(document.getElementById("fechaFinCurso").value);


    let fechaActual = new Date();


    let diferencia = finCurso - fechaActual;


    let diasRestantes = Math.ceil(diferencia / (1000 * 60 * 60 * 24));

    document.getElementById("act3").innerHTML = "Días restantes: " + diasRestantes;
}