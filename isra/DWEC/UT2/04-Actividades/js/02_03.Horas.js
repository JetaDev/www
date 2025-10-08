function listaHoras(){

    let resultado = "<p>";
    for(let hora=9; hora<=21; hora++){
        for(let min=0; min<60; min+=30){
            let horaFormateada = hora < 10 ? "0" + hora : hora;
            let minFormateada = min < 10 ? "0" + min : min;
            resultado += `${horaFormateada}:${minFormateada}<br>`;
        }
    }
    resultado += "</p>";
    document.getElementById("act2").innerHTML = resultado;
}

function listaHoras2(){
    //hasta maximo las 21:00, cada 5 minutos
    let resultado = "<ul>";
    for(let hora=9; hora<=20; hora++){
        for(let min=0; min<60; min+=5){
            let horaFormateada = hora < 10 ? "0" + hora : hora;
            let minFormateada = min < 10 ? "0" + min : min;
            resultado += `<li>${horaFormateada}:${minFormateada}</li>`;
        }


    }
    resultado += "<li>21:00<br></li>";
    resultado += "</ul>";
    document.getElementById("act2").innerHTML = resultado;
}