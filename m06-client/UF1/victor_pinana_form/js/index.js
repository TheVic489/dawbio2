

document.addEventListener("DOMContentLoaded", function () {
   
    // 0 . quan carrega, boto desabilitat
    document.getElementById("btRegistro").disabled = true;

    // 1. es valida al soritr dels camps --> associar un esdeveniment a cada camp, quin es el millor
    
    // Validar nombre on blur
    document.getElementById("tuNombre").addEventListener("blur", function () {
        
        myName = document.getElementById("tuNombre").value;
        
        var validateName = validaNomCognoms(myName); // Valido

        if (validateName == false) {
            document.getElementById("errorN").innerHTML = "Formato de nombre erroneo"
        }
     })
     // Quitar mensaje de error al hacer focus
     document.getElementById("tuNombre").addEventListener("focus", function () {

        document.getElementById("errorN").innerHTML = "";
     })

     // Validar apellidos on blur
     document.getElementById("tuApellidos").addEventListener("blur", function () {
        
        myApellido = document.getElementById("tuApellidos").value;
        
        var validateCognoms = validaNomCognoms(myApellido); // Valido

        if (validateCognoms == false) {
            document.getElementById("errorA").innerHTML = "Formato de apellidos erroneo"
        }
     })
     document.getElementById("tuApellidos").addEventListener("focus", function () {

        document.getElementById("errorA").innerHTML = "";
     })


     // Validar email on blur
     document.getElementById("tuEmail").addEventListener("blur", function () {
        
        myEmail = document.getElementById("tuEmail").value;
        
        var validateEmail = validaEmail(myEmail); // Valido

        if (validateEmail == false) {
            document.getElementById("errorE").innerHTML = "Email inválido"
        }
     })
     document.getElementById("tuEmail").addEventListener("focus", function () {

        document.getElementById("errorE").innerHTML = "";
     })


     //Validar dni on blur
     document.getElementById("tuDni").addEventListener("blur", function () {
        
        myDni = document.getElementById("tuDni").value;
        
        var validateDni = validaDni(myDni); // Valido

        if (validateDni == false) {
            document.getElementById("errorD").innerHTML = "Dni inválido"
        }
     })
     document.getElementById("tuDni").addEventListener("focus", function () {

        document.getElementById("errorD").innerHTML = "";
     })

    // 4 si tot ok, el boto es s'habilita (i es construeix dinamicament el text que diu el teu nom i cognom, edad i dies que et falten per l'aniversari.)

     document.getElementById("tuNac").addEventListener("blur",function () {

        myNac = document.getElementById("tuNac").value;

        var validateNac = validaNacimiento(myNac);

        if (validateNac == false) {
            document.getElementById("errorNac").innerHTML = "Es necesario ser mayor de edad"
        }
     })
     document.getElementById("tuNac").addEventListener("focus", function () {

        document.getElementById("errorNac").innerHTML = "";
     })

     

     document.getElementById("form").addEventListener("mouseover", function() {
        var errorNac = document.getElementById("errorNac").innerHTML;
        var errorN  = document.getElementById("errorN").innerHTML;
        var errorA  = document.getElementById("errorA").innerHTML;
        var errorE  = document.getElementById("errorE").innerHTML;
        var errorD  = document.getElementById("errorD").innerHTML;

     if (errorD === "" && errorA === "" && errorNac=== "" && errorN=== "" && errorE === "") {
        document.getElementById("btRegistro").disabled = false;
    }else{
        document.getElementById("btRegistro").disabled = true;
    }
    })

    document.getElementById("btRegistro").addEventListener("click", function () {

        var nombre     = document.getElementById("tuNombre").value;
        var apellidos  = document.getElementById("tuApellidos").value;
        var dni        = document.getElementById("tuDni").value;
        var email      = document.getElementById("tuEmail").value;
        var nacimiento = document.getElementById("tuNac").value;

        document.getElementById("respuesta").innerHTML= "Bienvenido " + nombre +" "+ apellidos + ", tu dni és " + dni + ", con email " + email + " y naciste el " + nacimiento;
    })


 });

function validaNacimiento(date){
    var today     = new Date();
    var birthDate = new Date(date);
    var age       = today.getFullYear() - birthDate.getFullYear();
    var months    = today.getMonth() - birthDate.getMonth();
    if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if (age >= 18 ) {
        return true
    }else{
        return false
    }
}


function validaNomCognoms(value){
    const expRegName = /^[A-ZÑa-zñáéíóúàèòÀÈÒÁÉÍÓÚ'°çÇ ]+$/;
    if (expRegName.test(value) == true)  {
        return true; // Correcto
    }else{
        return false;// Error
    }
}

function validaEmail(value){
    const expRegEmail=/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
    if (expRegEmail.test(value) == true)  {
        return true; // Correcto
    }else{
        return false;// Error
    }
}

function validaDni(rawDni){
     
    dni = rawDni.toUpperCase();
    // Separte numbers and letter
    numberDni  = dni.substr(0, dni.length -1);
    letterDni  = dni.substr(dni.length -1, dni.length);

    // Get module from numbers, and gets the letter 
    resto   = numberDni % 23;
    letters = 'TRWAGMYFPDXBNJZSQVHLCKET';
    letter  = letters.charAt(resto)
    //letter  = letters[resto]
    
    // Check if number is number and letter is letter
    if (isNaN(numberDni) && !isNaN(letterDni)) {
        document.getElementById("errorD").innerHTML = 'formato de DNI erroneo';
    } else {
        // Check if the letter introduced match with calculated one
        if (letterDni != letter || dni.length != 9) {
            document.getElementById("errorD").innerHTML = 'formato de DNI erroneo';
        } else {
            return true;
       }
    }
}
