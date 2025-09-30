function calcularNota(){
    let nota = document.getElementById("nota").value;
    let nombre = document.getElementById("nombre").value;
    if (nota<5) {
        document.getElementById("act1").innerHTML = `${nombre} está suspenso con un ${nota}`;
    } else{
        document.getElementById("act1").innerHTML = `${nombre} está aprobado con un ${nota}`;

    }
}