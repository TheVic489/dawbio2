<?php
require_once '/model/UserPersist.php';
require_once '/model/User.php';

define("USERFILE", "/files/users.txt");
define("DELIMITER", ";");

// Instantiate UserFIlePersist
$userPersister = new UserFilePersist(USERFILE, DELIMITER);
if (isset($_POST['submit'])) {
        $username = \filter_input(\INPUT_POST, 'username', \FILTER_SANITIZE_STRING);
    $username = \filter_var($username, \FILTER_SANITIZE_STRING);

    $password = \filter_input(\INPUT_POST, 'password', \FILTER_SANITIZE_STRING);
    $password = \filter_var($password, \FILTER_SANITIZE_STRING);

    if ($username == "" || $password == "") {
        echo "Introduce los datos";
    } else {
        $user  = new User($username, $password);
        $added = $userPersister->addUser($user);
        if ($added) {
            printf("<p>Added Succesfuly</p>");
            $message = "";
        } else {
            $message = 'Error adding user';
        }
    }
} else {
    $username = "";
    $password = "";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> User Registration Form</title>
</head>

<body>
    <fieldset>
        <legend>Create a new User!</legend>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <div>
                <label for="usernmae">Username:</label>
                <input type="text" name="username" id="">
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="text" name="password" id="">
            </div>
            <button type="submit" name="submit">Enviar</button>
            <p style="color:red" name="message"><?php echo $message ?? "";?></p>
    </fieldset>
    </form>
    <h4>Current Users</h4>
    <ul>
        <?php
        $userList = $userPersister->readAllUsers();
        foreach ($userList as $u) {
            printf("<li>%s</li>", $u);
        }
        ?>
    </ul>

</body>

</html>