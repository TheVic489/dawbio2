<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert user</title>
        <link rel="stylesheet" href="css/users.css"/>
    </head>
    <body>
        <h2>Update user</h2>
        <?php
        require_once "lib/Renderer.php";
        require_once "lib/Validator.php";
        require_once 'model/User.php';
        require_once "model/persist/UserPdoDbDao.php";
        $user = new user\model\User();
        
        $user = \lib\views\Validator::validateUser(INPUT_POST);
        if (filter_has_var(INPUT_POST, 'search')) {
            $sId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $userId = filter_var($sId, FILTER_VALIDATE_INT);
            if ($userId !== false) {
                echo "<p>Search user with id = $userId</p>";
                $dao = new user\model\persist\UserPdoDbDao();
                $user = new user\model\User($userId);
                $found = $dao->select($user);
                if (!is_null($found)) {
                    //echo "<p>User found: " . $found . "</p>";
                    echo "<form>";
                    echo lib\views\Renderer::renderUserFields2Modify($found);
                    echo "</form>";
                } else {
                    echo "<p>User with id = $userId not found</p>";
                }
            } else {
                echo "<p>A valid <em>id</em> shoud be provided</p>";
            }
        }

        
        if (filter_has_var(INPUT_POST, 'update')) {
            if ($user !== null) {
                $dao = new user\model\persist\UserPdoDbDao();
                $result = $dao->update($user);
                if ($result > 0) {
                    echo "<p>User successfully updated</p>";
                } else {
                    echo "<p>User not updated</p>";
                }
            } else {
                echo "<p>Valid data shoud be provided</p>";
            }            
        } 
        echo "<form method='post' action=\"$_SERVER[PHP_SELF]\">";
        echo lib\views\Renderer::renderUserFields($user);
        echo "<button type='update' name='update' value='insert'>Update</button>";
        echo "<button type='search' name='search' value='search'>Search</button>";
        echo "</form>";
        ?>
    </body>
</html>