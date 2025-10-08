function franjaEdad(){
    let edad = parseInt(document.getElementById("edad").value);
    let nombre = document.getElementById("nombre").value;
    let resultado = "";
    if(edad >= 0 && edad <= 12){
        resultado = "Niño";
    } else if(edad >= 13 && edad <= 17){
        resultado = "Adolescente";
    } else if(edad >= 18 && edad <= 64){
        resultado = "Trabajador";
    } else if(edad >= 65){
        resultado = "Jubilado";
    } else {
        resultado = "Edad no válida";
    }
    document.getElementById("act4").innerHTML = `<p><strong>${nombre} tiene ${edad} años por lo tanto es ${resultado}</strong></p>`;

}