<?php

require_once "fn_register.php";

if (isset($_POST['submit'])) {  //check if form has been sent.
    $user  = "";
    $pass  = "";
    
    //Init user and password vars
    $user = trim(filter_input(INPUT_POST, "user_input", FILTER_SANITIZE_SPECIAL_CHARS));
    $pass = trim(filter_input(INPUT_POST, "password_input", FILTER_SANITIZE_SPECIAL_CHARS));
    
    $result = "";
    $result = registerUser($user, $pass);
}



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form sample</title>
    <style>
        .related label {
            vertical-align: top;
        }
        h2 {
            background-color: lightgray;
        }
        div.labelinput {display: block; clear: both; margin: 10px; border: 5px;}
        label {display: inline; float: left; min-width: 15em; border: 5px;}
        input, span {display: inline; float: left;}
    </style>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

        <fieldset>
            <legend>Register</legend>
            
            <div class="labelinput">
                <label for="form_text">User :</label>
				<input type="text" name="user_input" value="" minlength="1" required placeholder="Input Username"/>
				<!--               name = (Variable que agafarà el servidor)                                                  -->
            </div>

            <div class="labelinput">
                <label for="form_text">Password :</label>
				<input type="password" name="password_input" value="" minlength="1" required placeholder="Input password here"/>
				<!--               name = (Variable que agafarà el servidor)                                                  -->
            </div>

            <div class="labelinput">
                <button type="submit" name="submit" value="sent">Submit</button>
            </div>

            <div class="labelinput">
                <p name="result"><?php echo $result ?? "";?></p>
            </div>

        </fieldset>
    </form>
    <?php if (isset($error) && strlen($error)>0) : ?>
        <p class="error"><?php echo $error ?? "";?></p>
        <?php endif; ?>
</body>
</html> 