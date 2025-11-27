let nombre = "Israel";
let apellidos = "García Pajas";
let curso = "2º DAW";
let favorito = "";

const modulos = [
  { modulo: "DWEC", horas: 6, profesor: "María" },
  { modulo: "DWES", horas: 8, profesor: "Aaron" },
  { modulo: "Proyectos", horas: 1, profesor: "Aaron" },
  { modulo: "Frameworks", horas: 3, profesor: "Aaron" },
  { modulo: "DAW", horas: 2, profesor: "No me acuerdo" },
  { modulo: "DIW", horas: 5, profesor: "Unai" },
];

document.getElementById("info").innerHTML = `<h3>Información del alumno</h3>`;
document.getElementById("info").innerHTML += `<p>Nombre: ${nombre}</p>`;
document.getElementById("info").innerHTML += `<p>Apellidos: ${apellidos}</p>`;
document.getElementById("info").innerHTML += `<p>Curso: ${curso}</p>`;

let tabla = `<table border="1">
                <tr>
                    <th>Módulo</th>
                    <th>Horas</th>
                    <th>Profesor</th>
                </tr>`;
for (let i = 0; i < modulos.length; i++) {
  tabla += `<tr>
              <td>${modulos[i].modulo}</td>
              <td>${modulos[i].horas}</td>
              <td>${modulos[i].profesor}</td>
            </tr>`;
}
tabla += `</table>`;
document.getElementById("tabla").innerHTML = tabla;


function moduloFavorito() {
  let respuesta = "";
  while (respuesta === "") {
    respuesta = prompt("¿Cuál es tu módulo favorito? (DWEC, DWES, Proyectos, Frameworks, DAW, DIW)");
    if (
      respuesta === "DWEC" ||
      respuesta === "DWES" ||
      respuesta === "Proyectos" ||
      respuesta === "Frameworks" ||
      respuesta === "DAW" ||
      respuesta === "DIW"
    ) {
      document.getElementById("fav").innerHTML = `Tu módulo favorito es: ${respuesta}`;
    } else {
      alert("Módulo no válido.");
      respuesta = "";
    }
  }
}
