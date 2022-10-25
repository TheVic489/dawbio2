
document.addEventListener("DOMContentLoaded", function () {

// Variables globals
var var1, var2, result;
let carrer="Carrer del Pi, 2";

    function debug(variable) {
        console.log(variable)
    }

    let cars = ['1', '12', '123', '1234', '12345']
    console.log(cars.join(''))
    
    // alternativa bucle for
    for(var car of cars){
        console.log(car)
    }

    function mult10(x) {
        x = x*10
    }

    var carsLen = cars.map((car) => car.length)
    debug(carsLen)
    tenCars = cars.forEach(mult10)
    debug(tenCars)

    // Como escribir texto desde JS
    // Codigo                     Cambiar texto (Cambia negrita) 
    document.getElementById("div1").innerHTML = "El <b>texto</b> se ha cambiado";

    //                            No interpreta HTML
    document.getElementById("div1").innerText += "El <b>texto</b> se ha cambiado";

    // Para reescribir la pagina
    // document.write("Este es el metodo write");

    //Cambios de estilo
    document.getElementById("div1").style.backgroundColor = "green";

    document.getElementById("p1").addEventListener("click", function () {
        document.getElementById("p1").innerHTML += "Hola";
        document.getElementById("p1").style.display = "None" //Desaparecer
    })

    document.getElementById("btAzul").addEventListener("click", function (){
        // Quiero añadir la clase azul al div 2
        //document.getElementsById("div2").classList.add("azul");
        
        // Quiero añadir a todos los divs de esta pagina
        let divs=document.getElementsByTagName("div");
        //let es per variables locals   
        for(let i = 0; i < divs.length; i++){
            divs[i].classList.remove("rojo")
            divs[i].classList.add("azul"); 
        };

    })

    document.getElementById("btRojo").addEventListener("click", function (){
        // Quiero añadir la clase rojo al div 2
        // document.getElementsById("div2").classList.add("rojo");
        
        // Quiero añadir a todos los divs de esta pagina
         let divs=document.getElementsByTagName("div");
         
         for(let i=0;i<divs.length;i++){
            divs[i].classList.remove("azul")
            divs[i].classList.add("rojo");
         };
    })
    
});


