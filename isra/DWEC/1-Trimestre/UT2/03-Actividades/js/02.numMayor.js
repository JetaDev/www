function mostrarMayor() {
  const num1 = parseFloat(document.getElementById("num1").value);
  const num2 = parseFloat(document.getElementById("num2").value);
  const num3 = parseFloat(document.getElementById("num3").value);

  let mayor = Math.max(num1, num2, num3);
  let mayorIFS;

  if (num1 >= num2 && num1 >= num3) {
    mayorIFS = num1;
  }else if (num2 >= num1 && num2 >= num3) {
    mayorIFS = num2;
  }else{
    mayorIFS = num3;
  }

  document.getElementById("act2").innerHTML =
    `El número mayor es: ${mayor} <br>
    Con if el número mayor es: ${mayorIFS}`;
}
