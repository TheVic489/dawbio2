<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--<!DOCTYPE html>-->
<!--<html>--> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!--<meta charset="UTF-8" />-->
	    <title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
	</head>
	<body>
		<form action="login_result.php" method="post">
			<fieldset>
				<legend>Login</legend>
				<label for="user">User:</label>
				<input type="text" id="user" name="user" value="" />
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" value="" />
				<input type="submit" name="submit" value="LOGIN" />
			</fieldset>
		</form>	
	</body>
</html>