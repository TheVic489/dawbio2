<?php
require_once './fn-php/fn_users.php';
session_start();
if (filter_has_var(INPUT_POST, "loginsubmit")) {
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));
	$user_array = searchUser($username, $password);
	///////
	$message = ""; 
  if (empty($user_array)) {
    $message = "This user doesn't exists";
	}
  if ($user_array) {
		$_SESSION["user_array"] = $user_array;
		header("Location: index.php");  //redirect to application page
	}
	
	
}   

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include_once "topmenu.php"; ?>
<div class="container-fluid">
  <h2>Login form</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="username" class="form-control" id="username" placeholder="Enter username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
  <!--  <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div> -->
    <input type="submit" name="loginsubmit" value="Submit" class="btn btn-default"></input>
</form>
	<div class="">
		<p><?php echo $message ?? ""; ?></p>

	</div>
	</div>

</div>
</body>
</html>