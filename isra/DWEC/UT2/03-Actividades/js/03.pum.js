function juegoPUM(){
  let salida = "";

  for (let i = 1; i <= 100; i++) {
    if (i % 7 === 0 || i.toString().endsWith("7")) {
      salida += "PUM <br>";
    } else {
      salida += i + ", ";
    }
  }

  document.getElementById("act3").innerHTML = salida;
}