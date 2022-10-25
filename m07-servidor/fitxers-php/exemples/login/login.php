<?php
require_once './lib/fn_login.php';

if (filter_has_var(INPUT_POST, "send")) {
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));
    $validCredentials = chekCredentials($username, $password);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form method="post">
            <div>
                <label>Username: </label>
                <input required name="username" type="text" value="<?php echo $username; ?>"/>
            </div>
            <div>
                <label>Password: </label>
                <input required name="password" type="text" value="<?php echo $password; ?>"/>
            </div>
            <div>
                <input name="send" type="submit" value="send"/>
            </div>
        </form>
        <?php 
            if (filter_has_var(INPUT_POST, "send")) {
                $text = $validCredentials?'valid':'invalid';
                echo "<p>Credentials are $text</p>";
            }
        ?>
    </body>
</html>
