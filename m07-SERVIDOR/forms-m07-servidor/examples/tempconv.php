<?php
/*   functions */
/**
 * converts celsius degrees to fahrenheit degrees.
 * @param $value the value of temp. in celsius.
 */
function celsius2fahrenheit(float $value): float {
    return ($value * 9.0 / 5.0) + 32.0;
}
/**
 * converts fahrenheit degrees to celsius degrees.
 * @param $value the value of temp. in fahrenheit.
 */
function fahrenheit2celsius(float $value): float {
    return ($value - 32.0) * 5.0 / 9.0;
}
/*  global code: retrieve data sent by form */
$formMethod = 'post';
$inputMetod = ($formMethod=='post') ? INPUT_POST : INPUT_GET;
if (!is_null(filter_input($inputMetod,'submit'))) { //if form submitted.
    //retrieve form parameters.
    $fDeg = (float) filter_input($inputMetod, 'f_deg');
    $cDeg = (float) filter_input($inputMetod, 'c_deg');
    //perform conversion.
    switch (filter_input($inputMetod,'submit')) {
        case 'f2c':
            $cDeg = fahrenheit2celsius($fDeg);
            break;
        case 'c2f':
            $fDeg = celsius2fahrenheit($cDeg);
            break;
    }
} else {
    $fDeg = 0.0;
    $cDeg = 0.0;
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Temperature converter</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            fieldset {background-color: lightgray;}
        </style>
    </head>
    <body>
        <h1>Temperature converter</h1>
        <form name="imc-form" method="<?php echo $formMethod;?>" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <fieldset>
            <legend>Temperature form</legend>
                <div>
                <label for="f_deg">Fahrenheit degrees: </label>
                <input type="text" name="f_deg" id ="f_deg" value="<?php printf("%.2f", $fDeg); ?>"></input>
                </div>
                <div>
                <label for="c_deg">Celsius degrees: </label>
                <input type="text" name="c_deg" id ="c_deg" value="<?php printf("%.2f", $cDeg); ?>"></input>
                </div>
                <div>
                <button type="submit" name="submit" value="f2c">F->C</button>
                <button type="submit" name="submit" value="c2f">C->F</button>
                </div>
            </fieldset>
        </form>    
    </body>
</html>