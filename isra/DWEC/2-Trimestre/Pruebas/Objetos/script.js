//Crear objeto vacio
let miObjeto = {};

//Crear objeto con valores
let persona = {
    nombre: "Isra",
    edad: 22,
    genero: "Masculino",
    esEstudiante: true,
    saludo: function () {
        console.log("Hola, me llamo " + this.nombre);
    }
};

console.log(persona.nombre);
persona.saludo();

console.log(persona.edad);
persona.edad = 23;
console.log(persona.edad);


console.log(Object.keys(persona));
console.log(Object.values(persona));
console.log(Object.entries(persona));
