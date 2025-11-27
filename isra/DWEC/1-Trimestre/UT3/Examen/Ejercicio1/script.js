//VENTANA PRINCIPALS
let nuevaVentana;
function abrirVentana() {
    nuevaVentana = window.open("ventana.html", "ventanaFecha", "width=500px", "height=300px")
}
function cerrarVentana() {
    nuevaVentana.close();
}

//VENTANA SECUNDARIA

// Establecer la fecha mínima como hoy y asi restringir un poco la eleccion de fecha(se puede poner a mano igualmente)
const inputFecha = document.getElementById('fechaInput');
const hoy = new Date();
const fechaMin = hoy.toISOString().split('T')[0];
let mensajeFestivos = "";
let mensajeError = "";
inputFecha.min = fechaMin;

// Cargar fecha guardada al iniciar
window.addEventListener('load', () => {
    const fechaGuardada = localStorage.getItem('ultimaFecha');
    if (fechaGuardada) {
        inputFecha.value = fechaGuardada;
        calcularDiasLaborables(); // Calcular automáticamente con la fecha guardada
    }
});

// Guardar fecha cuando cambie
inputFecha.addEventListener('change', (e) => {
    localStorage.setItem('ultimaFecha', e.target.value);
});

function calcularDiasLaborables() {
    const fechaInput = document.getElementById('fechaInput').value;
    if (!fechaInput) {
        alert('Por favor, seleccione una fecha');
        return;
    }

    const fechaFin = new Date(fechaInput);
    const fechaHoy = new Date();

    // Asegurarnos de que la fecha final es posterior a hoy
    if (fechaFin < fechaHoy) {
        mensajeError = "Fecha no válida";
        mensajeFestivos = "";
    }

    let diasLaborables = 0;
    let diasFestivos = 0;

    const fechaTemp = new Date(fechaHoy);

    // ponemos la hora a medianoche para comparar solo fechas
    fechaTemp.setHours(0, 0, 0, 0);
    fechaFin.setHours(0, 0, 0, 0);

    // Mientras no lleguemos a la fecha final
    while (fechaTemp <= fechaFin) {
        // getDay() devuelve 0-6 (Domingo-Sábado) depende del dia que toque suma a laborables o a festivos
        const dia = fechaTemp.getDay();
        if (dia >= 1 && dia <= 5) {
            diasLaborables++;
        }
        if (dia == 0 || dia == 6) {
            diasFestivos++;
        }
        //Si hay mas de 100 agrega un mensaje
        if (diasFestivos >= 100) {
            mensajeFestivos = "!Hay mas de 100 dias festivos¡"
        }

        // Avanzar al siguiente día
        fechaTemp.setDate(fechaTemp.getDate() + 1);
    }

    // Mostrar el resultado
    const resultDiv = document.getElementById('result');
    resultDiv.style.display = 'block';

    // Formatear la fecha para mostrarla
    const fechaFormateada = fechaInput.split('-').reverse().join('/');
    //html que se mostrara
    resultDiv.innerHTML = `
                <p><strong>Resultado del cálculo:</strong></p>
                <p style=color:red;>${mensajeError}</p>
                <p>Entre hoy y el ${fechaFormateada} hay:</p>
                <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 10px; text-align: left;">Tipo de días</th>
                        <th style="padding: 10px; text-align: center;">Cantidad</th>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">Días laborables (L-V)</td>
                        <td style="padding: 10px; text-align: center;">${diasLaborables}</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">Días festivos (S-D)</td>
                        <td style="padding: 10px; text-align: center;">${diasFestivos}</td>
                    </tr>
                </table>
                <p style=color:green;>${mensajeFestivos}</p>
            `;



}