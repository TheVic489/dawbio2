<?php session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--<!DOCTYPE html>-->
<!--<html>--> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!--<meta charset="UTF-8" />-->
	    <title>Login</title>
	</head>
	<body>
        <?php
            //user credentials.
            $usr = "alumne";
            $pass = "php"; 
            //filter and consume form data.
            if ( (filter_has_var(INPUT_POST, 'user')) && (filter_has_var(INPUT_POST, 'password')) ) { //variables received
                //clean values
                $user_input = htmlspecialchars(trim($_POST['user']));  
                $pass_input = htmlspecialchars(trim($_POST['password']));
                //validate values
                if ( (strlen($user_input)==0) || (strlen($pass_input)==0) ) {  //values not provided.
                    echo "<p>User and password required.</p>";
                    echo "<p>[<a href='login.php'>Login</a>]</p>";                      
                }
                else { 
                    if (($user_input === $usr) && ($pass_input === $pass)) {  //check values
                        $_SESSION["user_valid"] = true;
                        header("Location: logged.php");  //redirect to application page
                        exit;
                    }
                    else {  //bad login: redirect to login page again.
                        echo "<p>Access denied.</p>";
                        echo "<p>[<a href='login.php'>Login</a>]</p>";
                    }
                }
            } 
        ?>
	</body>
</html>