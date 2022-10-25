<?php
$formMethod = 'get';
$inputMetod = ($formMethod == 'post') ? INPUT_POST : INPUT_GET;
$message = "";
if (!is_null(filter_input($inputMetod, 'submit'))) { //if form submitted.
    //retrieve form parameters.
    $weight = filter_input($inputMetod, "weight", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $height = filter_input($inputMetod, "height", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (is_float($weight) && is_float($height)) {
        //calculate BMI.
        $bmi = $weight / ($height * $height);
    } else {
        $bmi = 0.0;
        $message = "invalid data";
    }
} else {
    $weight = 0.0;
    $height = 0.0;
    $bmi    = 0.0;
    $message = "form has not been submitted";
}
echo $message;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BMI calculator</title>
</head>

<body>
    <h1>Body mass index calculator</h1>
    <form name="bmi-form" method="<?php echo $formMethod; ?>" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            <legend>BMI form</legend>
            <div>
                <label for="weight">Weight (kg): </label>
                <input type="text" name="weight" id="weight" value="<?php printf("%.2f", $weight); ?>"></input>
            </div>
            <div>
                <label for="height">Height (m): </label>
                <input type="text" name="height" id="height" value="<?php printf("%.2f", $height); ?>"></input>
            </div>
            <div>
                <button type="submit" name="submit" value="submit">Submit</button>
            </div>
            <div>
                <label for="bmi">BMI (kg/m2): </label>
                <input type="text" name="bmi" value="<?php printf("%.2f", $bmi); ?>" disabled></input>
            </div>
        </fieldset>
    </form>
</body>

</html>