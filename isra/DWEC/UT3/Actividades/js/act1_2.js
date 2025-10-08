function calcularEdad(){
    let fechaNacimiento = document.getElementById("fechaNacimiento").value;
    let fechaActual = new Date();
    let nacimiento = new Date(fechaNacimiento);
    let edad = fechaActual.getFullYear() - nacimiento.getFullYear();
    let mes = fechaActual.getMonth() - nacimiento.getMonth();
    if (mes < 0 || (mes === 0 && fechaActual.getDate() < nacimiento.getDate())) {
        edad--;
    }
    document.getElementById("resultado").innerText = "Tu edad es: " + edad + " años.";

    //Verificar si es su cumpleaños
    if (mes === 0 && fechaActual.getDate() === nacimiento.getDate()) {
        alert("¡Feliz cumpleaños!");
    }
}