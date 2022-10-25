<?php

function varDumpPre(mixed $var)
{
    echo "<pre>";
    \var_dump($var);
    echo "</pre>";
}

if (isset($_POST['submit'], $_POST['operator'], $_POST['num2'])) {
	
	$num1     = (int)$_POST['num1'];
	$num2     = (int)$_POST['num2'];
	$operator = $_POST['operator'];
	
	if ($operator == "+")
		$result = $num1 + $num2;
	else if ($operator == "-")
		$result = $num1 - $num2;
	else if ($operator == "x")
		$result = $num1 * $num2;
	else if ($operator == "/")
		$result = $num1 / $num2; 
} 
?>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calculadora</title>
	<style>
		footer {margin-top: 17cm;}
		fieldset {margin: 10px}
		input { margin: 5px}
	</style>
</head>

<body>
	<div class="container">
		<form method="post" action="">
			<h1>Calculadora</h1>
			<fieldset>
			First Number:<input type="number" name="num1" value="">
			<br>
			Second Number:<input type="number" name="num2" value="">
			<br>
			<input type="radio" name="operator" value="+">+</input>
			<input type="radio" name="operator" value="-">-</input>
			<input type="radio" name="operator" value="x">x</input>
			<input type="radio" name="operator" value="/">/</input>
			<br>
			<input type="submit" value="Calculate" name="submit">
			</fieldset>
			<fieldset>
			<br>
			Result: <input disabled	 type='text' value="<?php echo $result ?? ""; ?>"><br>
			</fieldset>
		</form>
	</div>
	<div>
		<footer> Victor Piñana</footer>
</div>
</body>

</html>