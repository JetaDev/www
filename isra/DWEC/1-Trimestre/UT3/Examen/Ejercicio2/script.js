//Definimos las variables que necesitemos
const botonEmpezar = document.getElementById('botonEmpezar');
const clickButton = document.getElementById('clickButton');
const result = document.getElementById('result');
let cambiarTiempo;
let tiempoInicio;
let timeoutId;
let juegoActivo = false;
//Hace que el boton de hacer click cuando cambie de color este oculto desde el inicio
clickButton.style.display = 'none'

function tiempoRandom() {
    //tiempo aleatorio entre 2000 y 5000 milisegundos
    return Math.floor(Math.random() * 3000) + 2000;
}

//Funcion que inicia el juego
function empezarJuego() {

    juegoActivo = true;
    result.textContent = 'Prepárate...';
    botonEmpezar.style.display = 'none';
    clickButton.style.display = 'inline-block';
    document.body.style.backgroundColor = 'white';

    // Establecer el tiempo aleatorio para el cambio
    cambiarTiempo = tiempoRandom();

    // Programar el cambio de color
    timeoutId = setTimeout(() => {
        document.body.style.backgroundColor = 'green';
        tiempoInicio = Date.now();
        result.textContent = '¡AHORA!';
    }, cambiarTiempo);
}

//Funcion que comprueba cuando haces el click despues de darle a iniciar juego
function clickJuego() {
    //Aqui te advierte de que le has dado antes de tiempo y reinicia el juego automaticamente
    if (!juegoActivo || !tiempoInicio) {
        result.textContent = '¡Muy pronto! Espera a que la pantalla cambie de color.';
        reiniciarJuego();
        return;
    }

    const tiempoReaccion = Date.now() - tiempoInicio;
    result.textContent = `Tu tiempo de reacción: ${tiempoReaccion} milisegundos`;
    reiniciarJuego();
}

//Vuelve a como estaba al principio para poder volver a jugar
function reiniciarJuego() {
    juegoActivo = false;
    tiempoInicio = null;
    clearTimeout(timeoutId);
    document.body.style.backgroundColor = 'white';
    botonEmpezar.style.display = 'inline-block';
    clickButton.style.display = 'none';
    clickButton.disabled = false;
}

// Event Listeners
botonEmpezar.addEventListener('click', empezarJuego);
clickButton.addEventListener('click', clickJuego);
