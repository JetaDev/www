    document.writeln("<h3>Ejercicio 4 Menú</h3>")

let seguir = true;

while (seguir) {
    let opcion = prompt(
        "Elige una opción:\n" +
        "a) Área del triángulo (b*h/2)\n" +
        "b) Área del rectángulo (b*h)\n" +
        "c) Área del círculo (PI*r²)\n" +
        "d) Salir"
    );

    if (opcion === "a") {
        let base = parseFloat(prompt("Base triángulo"));
        let altura = parseFloat(prompt("Altura triángulo"));
        let area = (base * altura) / 2;
        document.writeln(`<p>Área del triángulo = ${area}</p>`) 

    }else if (opcion === "b") {
        let base = parseFloat(prompt("Base rectángulo"));
        let altura = parseFloat(prompt("Altura rectángulo"));
        let area = (base * altura) / 2;
        document.writeln(`<p>Área del rectángulo = ${area} </p>`) 

    }else if (opcion === "c") {
        let radio = parseFloat(prompt("Radio del círculo"));
        let area = Math.PI * (radio * radio);
        document.writeln(`<p>Área del círculo = ${area}</p>`)   
           
    }else if (opcion === "d") {
            seguir = false
    }else{
        window.alert("Dato no válido")

    }
}


    