function numeroCifras() {
let numero = document.getElementById("num").value;
let resultado = "";


  let centenas = (numero - (numero % 100)) / 100;

  let decenas = ((numero % 100) - (numero % 10)) / 10;

  let unidades = numero % 10;

    if (centenas > 0) {
        resultado += centenas + " centenas ";
    }

    if (decenas > 0) {
        resultado += decenas + " decenas ";
    }
    if (unidades > 0) {
        resultado += unidades + " unidades";
    }



  document.getElementById("numeros").innerHTML = `El número ${numero} tiene: ${resultado}`;
}
