$(document).ready( function () {

    $("tr:even>td:odd").css("background-color" , "black");
    $("tr:odd>td:even").css("background-color" , "black");


    $("tr:odd>td:odd").css("background-color" , "white");
    $("tr:even>td:even").css("background-color" , "white");



    // Ejercicio 2
    // Suma
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