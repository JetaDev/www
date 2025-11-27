function numeros(){
    let resultado = "";
    let numero;
    do{
        let numero = parseInt(prompt("Introduce un número (0 para salir):"));
        if(numero !== 0){
            resultado += numero + " ";
        }else if (numero === 0){
            resultado += "(fin)";
            break;
        }

    }while(numero !== 0);

    document.getElementById("ej5").innerHTML = `Números introducidos: ${resultado}`;
}