function duplicar(x){
    x = x * 2;
    console.log("Dentro de la función: " + x);
}
let numero = 5;
duplicar(numero);
console.log("Después de la función: " + numero);

function agregarElemento(arr, elemento){
    arr.push(elemento);
    console.log("Dentro de la función: " + arr);
}
let miArray = [1, 2, 3];
agregarElemento(miArray, 4);
console.log("Después de la función: " + miArray);


//Operador REST(...)
function sumaRest(...numeros){
    let resultado = 0;
    for (const num of numeros){
        resultado += num;
    }
    return resultado;
}
console.log(`Suma de 5 números con el operador REST(...): ${sumaRest(1,2,3,4,5)}`)
console.log(`Suma de 3 números con el operador REST(...): ${sumaRest(1,2,3)}`)

//Arguments
function sumaArguments(){
    let resultado = 0;
    for (let i = 0; i< arguments.length; i++) {
      resultado += arguments[i];
    
    }
    return resultado;
}
console.log(`Suma de 5 números con arguments: ${sumaArguments(1,2,3,4,5)}`)
console.log(`Suma de 3 números con arguments: ${sumaArguments(1,2,3)}`)

//Funciones Flecha
let nombre = 'Isra'
const saludar = (nombre) => console.log(`Hola ${nombre}`);
saludar(nombre);