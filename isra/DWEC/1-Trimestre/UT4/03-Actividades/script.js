let resultado1 = document.getElementById("resultado1");
let array1 = ["Jazz", "Blues"];

const agregar = () => {
    array1.push("rock n roll");
}

const mostrarArray = () => {
    resultado1.innerHTML = `Array actual: [${array1.join(", ")}]`;
}

const reemplaza = () => {
    let medio = Math.floor((estilos.length - 1) / 2);
    estilos[medio] = "Classics";
}
