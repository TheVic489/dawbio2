<?php
if (isset($_POST['submit'])) {
    // Sanitize all inputs 
    $amount = \filter_input(\INPUT_POST, 'amount', \FILTER_SANITIZE_NUMBER_FLOAT, \FILTER_FLAG_ALLOW_FRACTION);
    $amount = \filter_var($amount, \FILTER_VALIDATE_FLOAT);

    var_dump($amount);
    // Selected coin option, in variables.
    $coin1 = $_POST['coin1'];
    $coin2 = $_POST['coin2'];
    
    $result = 0.0;
    
    if ($coin1 == "AUD" and $coin2 == "JPY") {
        $result = $amount * 82.463;
    }
    
    if ($coin1 == "AUD" and $coin2 == "INR") {
        $result = $amount * 51.09;
    }
    
    if ($coin1 == "AUD" and $coin2 == "PHP") {
        $result = $amount * 37.15;
    }
    
    if ($coin1 == "USD" and $coin2 == "JPY") {
        $result = $amount * 109.49;
    }
    
    if ($coin1 == "USD" and $coin2 == "INR") {
        $result = $amount * 67.83;
    }
    
    if ($coin1 == "USD" and $coin2 == "PHP") {
        $result = $amount * 49.32;
    }    


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coin Converter </title>
    <style>
		fieldset {margin: 10px}
		select { margin: 5px}
		input { margin: 10px;}
	</style>
</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            Enter Amount:<input type="text" name="amount"><br>
            <legend>Currency Converter</legend>
            From:<select name='coin1'>
                    <option value="AUD">Australian Dollor(AUD)</option>
                    <option value="USD" selected>US Dollar(USD)</option>
                </select>
            <br>
            To:<select name='coin2'>
                    <option value="INR" selected>Indian Rupee(INR)</option>
                    <option value="JPY">Japanese Yen(JPY)</option>
                    <option value="PHP">PHilippine Peso(PHP)</option>
                </select>
        </fieldset>
        <fieldset>
			<br>
			Result: <input disabled	 type='text' value="<?php echo $result ?? ""; ?>"><br>
		</fieldset>
        <div>
            <input type='submit' name='submit' value="Convert" style="height:40px; width:70px">
        </div>
    </form>
</body>

</html>