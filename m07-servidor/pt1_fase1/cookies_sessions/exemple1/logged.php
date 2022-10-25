<?php
session_start();
if (!isset($_SESSION['user_valid'])) {
    header("Location: login.php");
    exit;
}
 ?>
<!DOCTYPE html>
<html> 
	<head>
		<meta charset="UTF-8" />
	    <title>Logged</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
	</head>
	<body>
        <nav>
            <a href="form.php">Forms input types</a>
            <a href="form2.php">DNA form</a>
            <a href="logout.php">Logout</a>
        </nav>
    </body>
</html>