const btnRellenar = document.getElementById('btnRellenar');
const btnTraspuesta = document.getElementById('btnTraspuesta');
const inputFilas = document.getElementById('nFilas');
const inputColumnas = document.getElementById('nColumnas');
const contenedorTabla = document.getElementById('contenedorTabla');

const abecedario = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

function limpiarTabla() {
    contenedorTabla.innerHTML = '';
}

function crearTabla(modo) {
    limpiarTabla();

    const filas = parseInt(inputFilas.value);
    const columnas = parseInt(inputColumnas.value);

    const tabla = document.createElement('table');

    let matriz = [];
    for (let i = 0; i < filas; i++) {
        matriz[i] = new Array(columnas);
    }

    let contadorLetras = 0;

    if (modo === 'filas') {
        for (let i = 0; i < filas; i++) {
            for (let j = 0; j < columnas; j++) {
                if (contadorLetras < abecedario.length) {
                    matriz[i][j] = abecedario[contadorLetras];
                } else {
                    matriz[i][j] = "-";
                }
                contadorLetras++;
            }
        }
    } else {
        for (let j = 0; j < columnas; j++) {
            for (let i = 0; i < filas; i++) {
                if (contadorLetras < abecedario.length) {
                    matriz[i][j] = abecedario[contadorLetras];
                } else {
                    matriz[i][j] = "-";
                }
                contadorLetras++;
            }
        }
    }

    for (let i = 0; i < filas; i++) {
        const tr = document.createElement('tr');
        for (let j = 0; j < columnas; j++) {
            const td = document.createElement('td');
            td.textContent = matriz[i][j];
            tr.appendChild(td);
        }
        tabla.appendChild(tr);
    }

    contenedorTabla.appendChild(tabla);
}




function calcularTraspuesta() {
    limpiarTabla();

    const filas = 3;
    const columnas = 3;

    let matrizOriginal = [];
    let numero = 1;
    for (let i = 0; i < filas; i++) {
        matrizOriginal[i] = [];
        for (let j = 0; j < columnas; j++) {
            matrizOriginal[i][j] = numero;
            numero++;
        }
    }

    let matrizTraspuesta = [];
    for (let i = 0; i < columnas; i++) {
        matrizTraspuesta[i] = [];
        for (let j = 0; j < filas; j++) {
            matrizTraspuesta[i][j] = matrizOriginal[j][i];
        }
    }

    const contenedor = document.createElement('div');
    contenedor.style.display = 'flex';
    contenedor.style.gap = '30px';
    contenedor.style.marginTop = '20px';

    const divOriginal = document.createElement('div');
    const tituloOriginal = document.createElement('h3');
    tituloOriginal.textContent = 'Matriz Original';
    divOriginal.appendChild(tituloOriginal);

    const tablaOriginal = document.createElement('table');
    for (let i = 0; i < filas; i++) {
        const tr = document.createElement('tr');
        for (let j = 0; j < columnas; j++) {
            const td = document.createElement('td');
            td.textContent = matrizOriginal[i][j];
            tr.appendChild(td);
        }
        tablaOriginal.appendChild(tr);
    }
    divOriginal.appendChild(tablaOriginal);

    const divTraspuesta = document.createElement('div');
    const tituloTraspuesta = document.createElement('h3');
    tituloTraspuesta.textContent = 'Matriz Traspuesta';
    divTraspuesta.appendChild(tituloTraspuesta);

    const tablaTraspuesta = document.createElement('table');
    for (let i = 0; i < columnas; i++) {
        const tr = document.createElement('tr');
        for (let j = 0; j < filas; j++) {
            const td = document.createElement('td');
            td.textContent = matrizTraspuesta[i][j];
            tr.appendChild(td);
        }
        tablaTraspuesta.appendChild(tr);
    }
    divTraspuesta.appendChild(tablaTraspuesta);

    contenedor.appendChild(divOriginal);
    contenedor.appendChild(divTraspuesta);
    contenedorTabla.appendChild(contenedor);
}

btnRellenar.addEventListener('click', () => crearTabla('filas'));
btnTraspuesta.addEventListener('click', calcularTraspuesta);
