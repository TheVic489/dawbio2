<?php
require_once './lib/ex6fn.php';

if (filter_has_var(INPUT_POST, 'btnSubmit')) { //assess that form has been sent

    // Sanitize potato kg amount
    $potato_kg = filter_input(\INPUT_POST, 'potato_kg', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $potato_kg = filter_var($potato_kg, \FILTER_VALIDATE_FLOAT);

    // Price calculator    
    $pricePerKg = priceCalc($potato_kg);
    $price = ($pricePerKg * $potato_kg);
    var_dump($price);
} else {
    $price = 0.0; // If the form is not sent, reset de price value
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patatas</title>
    <style>
        fieldset {margin: 10px}
		input { margin: 5px}
        button {margin: 4px; margin-left: 10px; height:40px; width:70px}
        span {padding-bottom: 5px;}
        p {width: 200px;}
        p > span {
        display: inline-block;
        margin-bottom: 5px;
        background-color: skyblue;
        font-weight: bold;}
            

    </style>
</head>

<body>
    <h1>Buy Potatoes!</h1>
    
    <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            <legend>Select amount</legend>
            <div>
                Potatoes (kg): <input type="number" step="0.01" name="potato_kg" max="1000" min="1" placeholder="max: 100kg, min: 1kg" value=""> 
                <br>
                <p>
                <span>
                </span>
                </p>
            </div>
        </fieldset>
        <button type="submit" name="btnSubmit" style="font-size : 20px;" value="submit">Buy</button>
        <fieldset>
            <legend>Amount to pay</legend>
			Price: <input disabled	 type='text' value="<?php echo $price ?? ""; ?>€"><br>
        </fieldset>
        
    </form>
</body>

</html>