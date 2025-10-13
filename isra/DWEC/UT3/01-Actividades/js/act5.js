function domingosCumple(){
    let fechaNacimiento = new Date(document.getElementById("fechaNacimiento2").value);
    let fechaActual = new Date();

    let anioActual = fechaActual.getFullYear();
    let cumpleAnioActual = new Date(anioActual, fechaNacimiento.getMonth(), fechaNacimiento.getDate());
    let domingos = 0;

    // Si el cumpleaños de este año ya pasó, considerar el próximo año
    if (cumpleAnioActual < fechaActual) {
        anioActual++;
        cumpleAnioActual = new Date(anioActual, fechaNacimiento.getMonth(), fechaNacimiento.getDate());
    }
    // Contar domingos desde hoy hasta el 2100
    for (let anio = anioActual; anio <= 2100; anio++) {
        let cumple = new Date(anio, fechaNacimiento.getMonth(), fechaNacimiento.getDate());
        if (cumple.getDay() === 0) { // 0 es domingo
            domingos++;
        }
    }
    document.getElementById("act5").textContent = "Número de domingos que vas a cumplir años desde este año hasta el 2100: " + domingos;
}