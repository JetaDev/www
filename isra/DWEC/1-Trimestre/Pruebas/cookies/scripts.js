function guardarCookie() {
  let mensaje = "Cookie: Hola";
  document.cookie = `menaje=${mensaje};expires=01 Jan 2099`;
}
function leerCookie() {
    let cookies = document.cookie.split("; ");
    let mensajeSalida = "Mensaje no encontrado";
    for (const cookie of cookies) {
        let [nombre, valor] = cookie.split("=");
        if (nombre === "menaje") {
            mensajeSalida = valor;
            break;
        }
    }
    document.getElementById("mensaje").textContent = mensajeSalida;
}