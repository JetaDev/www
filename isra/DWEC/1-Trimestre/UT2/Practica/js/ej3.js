function evaluar() {
    let ex1 = parseFloat(document.getElementById("ex1").value);
    let ex2 = parseFloat(document.getElementById("ex2").value);
    let tr1 = parseFloat(document.getElementById("tr1").value);
    let tr2 = parseFloat(document.getElementById("tr2").value);

    let resultado = document.getElementById("resultadoNota");

    if(ex1 < 5|| ex2 < 5){
        resultado.innerHTML = "Has suspendido el curso";
    }
    if(tr1 < 4.5 || tr2 < 4.5){
        resultado.innerHTML = "Has suspendido el curso";
    }

    let mediaExamenes = (ex1 + ex2) / 2;
    let mediaTrabajos = (tr1 + tr2) / 2;
    let mediaFinal = (mediaExamenes * 0.75) + (mediaTrabajos * 0.25);

    if(mediaFinal >= 5){
        resultado.innerHTML = "Has aprobado el curso con una nota de: " + mediaFinal.toFixed(2);
    }else{
        resultado.innerHTML = "Has suspendido el curso con una nota de: " + mediaFinal.toFixed(2);
    }
}