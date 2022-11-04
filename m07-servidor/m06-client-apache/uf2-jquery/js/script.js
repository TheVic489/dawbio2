$(document).ready( function () {
    // Al carrega, amagar divs
    $("#div2").hide()
    $("#div3").hide()
    $('#calculadora').click(function () {
        $("#div2").show()
        $("#div3").hide()
        $("#div1").hide()
    })
    $('#form').click(function () {
        $("#div1").show()
        $("#div3").hide()
        $("#div2").hide()

    })
    $('#tablero').click(function () {
        $("#div1").hide()
        $("#div2").hide()
        $("#div3").show()
    })

    //Exercici 1 : Form

    // 0 . quan carrega, boto desabilitat
    $("#btRegistro").prop('disabled', true);

    // 1. es valida al soritr dels camps --> associar un esdeveniment a cada camp, quin es el millor
    
    // Validar nombre on blur
    $("#myName").blur(function () {

        myName = $("#myName").val();
        let validateName = validaNomCognoms(myName); // Valido
        if (validateName == false) {
            $("#errorN").html("Formato de nombre erroneo"); 
        }
     })

     console.log(validateName)









    // Tabla de ajedrez
    $("tr:even>td:odd").css("background-color" , "black");
    $("tr:odd>td:even").css("background-color" , "black");


    $("tr:odd>td:odd").css("background-color" , "white");
    $("tr:even>td:even").css("background-color" , "white");



    // Ejercicio 2
    // Calculadora
    $("#btSuma").click(function () {

        var firstValue  = parseFloat($("#input21").val());
        var secondValue = parseFloat($("#input22").val());

        let result = (firstValue) + (secondValue);
        console.log(result);

        var max = Math.max(firstValue, secondValue);
        $("#max").html('El valor més gran és : ' + max) ; 
        //Check if is a NaN
        if (isNaN(firstValue) || isNaN(secondValue)) {
            $("#result").html("Els camps han de ser numerics"); 
        } else {
            $("#result").html('El resultado és : ' + result) ; 
        }

    })

    // Resta
    $("#btResta").click(function () {
        
        var firstValue  = parseFloat($("#input21").val());
        var secondValue = parseFloat($("#input22").val());

        let result = (firstValue) - (secondValue);

        $("#result").html('El resultado és : ' + result) ; 
        //Check if is a NaN
        if (isNaN(firstValue) || isNaN(secondValue)) {
            $("#result").html("Els camps han de ser numerics"); 
        } else {
            $("#result").html('El resultado és : ' + result) ; 
        }

    
    })

    // Multiplicació
    $("#btMult").click( function () {
        
        var firstValue  = parseFloat($("#input21").val());
        var secondValue = parseFloat($("#input22").val());
        
        let result = (firstValue) * (secondValue);
        console.log(result);
        
        $("#result").html('El resultado és : ' + result) ; 
        //Check if is a NaN
        if (isNaN(firstValue) || isNaN(secondValue)) {
            $("#result").html("Els camps han de ser numerics"); 
        } else {
            $("#result").html('El resultado és : ' + result) ; 
        }

    })

    // Division
    $("#btDivi").click( function () {

        var firstValue  = parseFloat($("#input21").val());
        var secondValue = parseFloat($("#input22").val());

        let result = (firstValue) / (secondValue);

        $("#result").html('El resultado és : ' + result) ; 
        //Check if is a NaN
        if (isNaN(firstValue) || isNaN(secondValue)) {
            $("#result").html("Els camps han de ser numerics"); 
        } else {
            $("#result").html('El resultado és : ' + result) ; 
        }

    })


});

function validaNomCognoms(value){
    const expRegName = /^[A-ZÑa-zñáéíóúàèòÀÈÒÁÉÍÓÚ'°çÇ ]+$/;
    if (expRegName.test(value) == true)  {
        return true; // Correcto
    }else{
        return false;// Error
    }
}