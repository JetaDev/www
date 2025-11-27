function mostrarLista() {
    const inputProducto = document.getElementById('nombreProducto');
    const listaProductos = document.getElementById('listaProductos');

    const nombre = inputProducto.value.trim();

    const lista = document.createElement('li');
    lista.textContent = nombre + ' ';

    const botonBorrar = document.createElement('button');
    botonBorrar.textContent = 'X';

    botonBorrar.onclick = function () {
        listaProductos.removeChild(lista)
    };

    lista.appendChild(botonBorrar);

    listaProductos.appendChild(lista);


}

function mostrarImagen() {
    const inputImagen = document.getElementById('urlImagen');
    const contenedorImagen = document.getElementById('contenedorImagen');

    const url = inputImagen.value;
    const imagen = document.createElement('img');

    imagen.src = url
    imagen.alt = "Imagen cargada dinámicamente";

    contenedorImagen.appendChild(imagen)
}

function crearNuevaTarjeta() {

    const inputURL = document.getElementById('imagenURL');
    const inputTitulo = document.getElementById('tituloTarjeta');
    const inputDescripcion = document.getElementById('descripcion');
    const contenedorTarjetas = document.getElementById('contenedorTarjetas');

    const imagenUrl = inputURL.value;
    const titulo = inputTitulo.value;
    const descripcion = inputDescripcion.value;




    const tarjeta = document.createElement('div');
    tarjeta.classList.add('tarjeta');


    const imagen = document.createElement('img');
    imagen.src = imagenUrl;
    imagen.alt = titulo;


    const tituloElemento = document.createElement('h3');
    tituloElemento.textContent = titulo;

    const descripcionElemento = document.createElement('p');
    descripcionElemento.textContent = descripcion;

    const botonBorrar = document.createElement('button');
    botonBorrar.textContent = 'Borrar Tarjeta';

    botonBorrar.onclick = function () {
        contenedorTarjetas.removeChild(tarjeta);
    };


    tarjeta.appendChild(imagen);
    tarjeta.appendChild(tituloElemento);
    tarjeta.appendChild(descripcionElemento);
    tarjeta.appendChild(botonBorrar);

    contenedorTarjetas.appendChild(tarjeta);


    inputURL.value = '';
    inputTitulo.value = '';
    inputDescripcion.value = '';
}

function completarTarea(liElement) {
    if (liElement.style.textDecoration === 'line-through') {
        liElement.style.textDecoration = 'none';
        liElement.style.opacity = '1';
    } else {
        liElement.style.textDecoration = 'line-through';
        liElement.style.opacity = '0.7';
    }
}

function eliminarTarea(liElement) {
    const lista = document.getElementById('listaTareas');

    lista.removeChild(liElement);

}

function agregarTarea() {
    const input = document.getElementById('nuevaTarea');
    const tareaTexto = input.value;
    const lista = document.getElementById('listaTareas');


    const li = document.createElement('li');
    li.textContent = tareaTexto;

    const btnCompletar = document.createElement('button');
    btnCompletar.textContent = ' ✅ ';
    btnCompletar.style.marginLeft = '10px';

    btnCompletar.addEventListener('click', function () {
        completarTarea(li);
    });

    const btnEliminar = document.createElement('button');
    btnEliminar.textContent = ' ❌ ';
    btnEliminar.style.marginLeft = '5px';

    btnEliminar.addEventListener('click', function () {
        eliminarTarea(li);
    });

    // 4. Anidar y mostrar
    li.appendChild(btnCompletar);
    li.appendChild(btnEliminar);
    lista.appendChild(li);


}

function agregarFila() {
    const contenedorTabla = document.getElementById('contenedorTabla');
    const nombreInput = document.getElementById('nombreInput');
    const precioInput = document.getElementById('precioInput');

    const nombre = nombreInput.value.trim();
    const precio = precioInput.value.trim();

    if (nombre === "" || precio === "") {
        alert("Introduce Nombre y Precio.");
        return;
    }

    let tabla = contenedorTabla.querySelector('table');


    tabla = document.createElement('table');



    const filaCabecera = document.createElement('tr');

    const th1 = document.createElement('th');
    th1.textContent = 'PRODUCTO';
    th1.style.border = '1px solid #ddd';
    const th2 = document.createElement('th');
    th2.textContent = 'PRECIO';
    th2.style.border = '1px solid #ddd';

    filaCabecera.appendChild(th1);
    filaCabecera.appendChild(th2);

    tabla.appendChild(filaCabecera);

    contenedorTabla.appendChild(tabla);


    const tr = document.createElement('tr');

    const tdNombre = document.createElement('td');
    tdNombre.textContent = nombre;
    tdNombre.style.border = '1px solid #ddd';

    const tdPrecio = document.createElement('td');
    tdPrecio.textContent = parseFloat(precio).toFixed(2) + ' €';
    tdPrecio.style.border = '1px solid #ddd';

    tr.appendChild(tdNombre);
    tr.appendChild(tdPrecio);

    tabla.appendChild(tr);

    nombreInput.value = '';
    precioInput.value = '';
    nombreInput.focus();
}

const agregarBoton = document.getElementById('agregarBtn');
agregarBoton.addEventListener('click', agregarTarea);
