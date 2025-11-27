function calcularLetraDNI() {
    let dni = parseInt(document.getElementById("dni").value);
    let letra = 'TRWAGMYFPDXBNJZSQVHLCKE'[dni % 23];
    document.getElementById("act6").innerHTML = `<p><strong>Tu letra del DNI es: ${letra}</strong></p>`;

}