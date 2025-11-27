function cadenas() {
    let cadena = document.getElementById("cadena").value;
    let num = document.getElementById("num").value;
    let resultado = "";

    resultado += `<table border="1">
    <tr>
    <th>Mayuscula</th>
    <th>Minuscula</th>
    <th>Longitud</th>
    <th>Subcadena</th>
    <th>Por separado</th>
    </tr>
    <tr>
    <td>${cadena.toUpperCase()}</td>
    <td>${cadena.toLowerCase()}</td>
    <td>${cadena.length}</td>
    <td>${cadena.substring(0, num)}</td>
    <td>${cadena.split(" ")}</td>
    </tr>
    </table>`;
    document.getElementById("resultado1").innerHTML = resultado;

}

function reemplazar(){
    let cadena = document.getElementById("cadena").value;
    let resultado = "";

    let cadenaSeparada = cadena.split("");
    resultado += cadenaSeparada.join("-");
    document.getElementById("resultado2").innerHTML = resultado;


}

function vocales(){
    let cadena = document.getElementById("cadena").value;
    let resultado = "";
    let contador = 0;
    let vocales = "aeiouAEIOU";
    for(let i=0; i<cadena.length; i++){
        if(vocales.indexOf(cadena.charAt(i)) !== -1){
            contador++;
        }
    }
    resultado += `La cadena tiene ${contador} vocales.`;
    document.getElementById("resultado3").innerHTML = resultado;
}

function extraer(){
    let cadena = document.getElementById("cadena").value;
    let resultado = "";
    let inicio = cadena.indexOf("(");
    let fin = cadena.indexOf(")");
    if(inicio !== -1 && fin !== -1 && fin > inicio){
        let extraido = cadena.substring(inicio + 1, fin);
        resultado += `El texto extraído entre paréntesis es: ${extraido}`;
    } else {
        resultado += "No se encontraron paréntesis o están mal colocados.";
    }   
    document.getElementById("resultado4").innerHTML = resultado;
}

function alRevesConReverse(){
    let cadena = document.getElementById("cadena").value;
    let resultado = "";
    let cadenaReves = cadena.split("").reverse().join("");
    resultado += `La cadena al revés es: ${cadenaReves}`;
    document.getElementById("resultado5").innerHTML = resultado;
}

function alReves(){
    let cadena = document.getElementById("cadena").value;
    let resultado = "";
    let cadenaReves = "";

    for (let i = cadena.length - 1; i >= 0; i--) {
        cadenaReves += cadena[i];
    }

    resultado += `La cadena al revés es: ${cadenaReves}`;
    document.getElementById("resultado5").innerHTML = resultado;
}

function palindromo(){
    let cadena = document.getElementById("cadena").value;
    let resultado = "";

    cadena = cadena.toLowerCase();

    let invertida = "";
    for (let i = cadena.length - 1; i >= 0; i--) {
        invertida += cadena[i];
    }

    if (cadena === invertida && cadena.length > 0) {
        resultado = `${cadena} es un palíndromo.`;
    } else {
        resultado = `${cadena} no es un palíndromo.`;
    }

    document.getElementById("resultado6").innerHTML = resultado;
}

function contarNumeros(){

    let cadena = document.getElementById("cadena").value;
    let resultado = "";
    let contador = 0;
    for(let i=0; i<cadena.length; i++){
        if(!isNaN(cadena.charAt(i)) && cadena.charAt(i) !== " "){
            contador++;
        }
    }
    resultado += `La cadena tiene ${contador} números.`;
    document.getElementById("resultado7").innerHTML = resultado;
}

