function diasFinCurso2() {
    let finCurso = new Date(document.getElementById("fechaFinCurso").value);

    let fechaActual = new Date();

    let diasHabiles = 0;

    // Recorrer desde hoy hasta la fecha de fin
    let fechaTemp = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), fechaActual.getDate());
    while (fechaTemp <= finCurso) {
        let diaSemana = fechaTemp.getDay(); // 0=domingo, 6=sábado
        if (diaSemana != 0 && diaSemana != 6) {
            diasHabiles++;
        }

        fechaTemp.setDate(fechaTemp.getDate() + 1);
    }

    document.getElementById("act4").textContent = "Días hábiles restantes: " + diasHabiles;
}