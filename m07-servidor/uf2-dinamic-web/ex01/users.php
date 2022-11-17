<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'classes/User.php';

/**
 * prints credentialas about the user
 * @param Product product
 */
function printUserCredentials(User $user)
{
    echo "<li>", $user, "</li>";
}

/**
 * prints  User
 * @param array 
 */
function printUser(array $list)
{
    echo "<p>Printing ", count($list), " elements</p>";
    echo "<ul>";
    foreach ($list as $elem) {
        printUserCredentials($elem);
    }
    echo "</ul>";
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> User Registration Form</title>
</head>

<body>
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
    </form>

    <?php
    $userList = array();
    if (isset($_POST['submit'])) {
        $username = \filter_input(\INPUT_POST, 'username', \FILTER_SANITIZE_STRING);
        $username = \filter_var($username, \FILTER_SANITIZE_STRING);

        $password = \filter_input(\INPUT_POST, 'password', \FILTER_SANITIZE_STRING);
        $password = \filter_var($password, \FILTER_SANITIZE_STRING);

        if ($username == "" || $password == "") {
            echo "Introduce los datos";
        } else {
            //define a list of Users.
            $user1 = new User($username, $password);
            
            $userSerial = serialize($user1);
            array_push($_SESSION['UserList'], $userSerial);

            foreach($_SESSION['UserList'] as $user ) {
                $userUnser = unserialize($user);
                array_push($userList, $userUnser);
            }

            printUser($userList);
            //print products information.
        }
    }else {
        $username = "";
        $password = "";

    }

    ?>
</body>

</html>