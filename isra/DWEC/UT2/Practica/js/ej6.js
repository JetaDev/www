function multiplos(){
    let num = parseInt(document.getElementById("num5").value);
    let resultado = "";
    for(let i = num; i <= 30; i++){
        if(i % 3 === 0){
            resultado += i + " ";
        }
    }
    document.getElementById("ej6").innerHTML = `Múltiplos de 3 desde ${num} hasta 30: ${resultado}`;
}