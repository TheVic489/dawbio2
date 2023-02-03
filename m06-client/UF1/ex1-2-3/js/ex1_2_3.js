document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("div1").style.display = "None" //Desaparecer
    document.getElementById("div2").style.display = "None" //Desaparecer
    document.getElementById("div3").style.display = "None" //Desaparecer

    document.getElementById("bt1").addEventListener("click", function () {
        document.getElementById("div1").style.display = "block";
        document.getElementById("div2").style.display = "None" //Desaparecer
        document.getElementById("div3").style.display = "None" //Desaparecer

    })

    document.getElementById("bt2").addEventListener("click", function () {
        document.getElementById("div2").style.display = "block";
        document.getElementById("div3").style.display = "None" //Desaparecer
        document.getElementById("div1").style.display = "None" //Desaparecer

    })

    document.getElementById("bt3").addEventListener("click", function () {
        document.getElementById("div3").style.display = "block" //Desaparecer
        document.getElementById("div2").style.display = "None";
        document.getElementById("div1").style.display = "None" //Desaparecer

    })
    // Ejercicio 1
    let factorial = 100;
    for (let i = factorial - 1; i >= 2; i--) {
        factorial *= i;
    }
    console.log(factorial)
    document.getElementById("div1").innerHTML = "<h5>El numero factorial és " + factorial +"</h5>"


    // Ejercicio 2
    // Suma
    document.getElementById("btSuma").addEventListener("click", function () {

        var firstValue = document.getElementById("input21").value;
        var secondValue = document.getElementById("input22").value;

        let result = parseFloat(firstValue) + parseFloat(secondValue);

        //Check if is a NaN
        if (isNaN(firstValue) || isNaN(secondValue)) {
            document.getElementById("result").innerHTML = "Els camps han de ser numerics"
        } else {
            document.getElementById("result").innerHTML = 'El resultado és : ' + result;
        }

    })

    // Resta
    document.getElementById("btResta").addEventListener("click", function () {

        var firstValue  = document.getElementById("input21").value;
        var secondValue = document.getElementById("input22").value;

        let result = parseInt(firstValue) - parseInt(secondValue);

        document.getElementById("result").innerHTML = 'El resultado és : ' + result;
    })

    // Multiplicació
    document.getElementById("btMult").addEventListener("click", function () {

        var firstValue  = document.getElementById("input21").value;
        var secondValue = document.getElementById("input22").value;

        let result = parseInt(firstValue) * parseInt(secondValue);

        document.getElementById("result").innerHTML = 'El resultado és : ' + result;
    })

    // Division
    document.getElementById("btDivi").addEventListener("click", function () {

        var firstValue  = document.getElementById("input21").value;
        var secondValue = document.getElementById("input22").value;

        let result = parseInt(firstValue) / parseInt(secondValue);

        document.getElementById("result").innerHTML = 'El resultado és : ' + result;
    })

    // Ejercicio 3
    document.getElementById("validar").addEventListener("click", function () {

        // Get dni var, and upper case
        dniRough = document.getElementById("dniInput").value;
        dni      = dniRough.toUpperCase();

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
            alert('formato de DNI erroneo');
        } else {
            // Check if the letter introduced match with calculated one
            if (letterDni != letter || dni.length != 9) {
                alert('DNI erroneo');
            } else {
                alert('DNI correcto')
            }
        }
    })

})