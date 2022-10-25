<?php

require_once "fn-php/fn_users.php";
$username = "";
$password = "";
$name     = "";
$surname  = "";
$error    = "";

// If form is sent
if (filter_has_var(INPUT_POST, "registersubmit")) {

  //Sanitize variables
  $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
  $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));
  $name     = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS));
  $surname  = trim(filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS));

  // Creating user
  $registerResult = registerUser($username, $password, 'registered', $name, $surname);

  // Interpreting errors
  if ($registerResult) {
    $result = "User successfuly created";
    echo "[<a href='index.php'>Main Page</a>]";
  } elseif (!$registerResult) {
    $result = "User already exisist";
  } else {
    $result = "An error has ocurred";
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <h2>Registration form</h2>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="username">Username:</label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="surname">Surname:</label>
        <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" required>
      </div>
      <button type="submit" name="registersubmit" class="btn btn-default">Submit</button>
      <div class="labelinput">
        <p name="result"><?php echo $result ?? ""; ?></p>
      </div>
    </form>
  </div>
</body>

</html>