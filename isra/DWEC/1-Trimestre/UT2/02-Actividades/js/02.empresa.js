// 2.	Realiza un programa que calcule el sueldo que le corresponde al trabajador de una empresa que cobra 40.000 euros anuales, el programa debe realizar los cálculos en función de los siguientes criterios:
// •	Si lleva más de 10 años en la empresa se le aplica un aumento del 10%.
// •	Si lleva menos de 10 años, pero más que 5, se le aplica un aumento del 7%.
// •	Si lleva menos de 5 años, pero más que 3, se le aplica un aumento del 5%.
// •	Si lleva menos de 3 años se le aplica un aumento del 3%.

let sueldo = 40000;
let tiempo = parseInt(prompt("Cuantos años llevas en la empresa"));

if (tiempo >= 10) {
    sueldo += (sueldo * 0.10) 
}else if (tiempo > 5) {
    sueldo += (sueldo * 0.07) 
}else if (tiempo > 3) {
    sueldo += (sueldo * 0.05) 
}else{
    sueldo += (sueldo * 0.03) 
}

    document.writeln("<h3>Ejercicio 2 sueldo</h3>")
    document.writeln(`Teniendo ${tiempo} años en la empresa tu sueldo pasa de 40000 a ${sueldo}`)
