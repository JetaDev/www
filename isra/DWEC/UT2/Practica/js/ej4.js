function diasMes() {
  let mes = document.getElementById("mes").value.toLowerCase();

  let dias;

  switch (mes) {
    case "enero":
    case "marzo":
    case "mayo":
    case "julio":
    case "agosto":
    case "octubre":
    case "diciembre":
      dias = 31;
      document.getElementById("dias").innerHTML= `El mes de ${mes} tiene ${dias} días.`;
      break;

    case "abril":
    case "junio":
    case "septiembre":
    case "noviembre":
      dias = 30;
      document.getElementById("dias").innerHTML= `El mes de ${mes} tiene ${dias} días.`;

      break;

    case "febrero":
      dias = 28;
      document.getElementById("dias").innerHTML= `El mes de ${mes} tiene ${dias} días.`;

      break;

    default:
      alert(
        "Mes no válido. Asegúrate de escribirlo en minúsculas y sin tildes."
      );
      break;
  }
}
