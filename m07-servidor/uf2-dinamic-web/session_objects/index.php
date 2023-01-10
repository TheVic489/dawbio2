<?php
include "classes/User.php";
if (filter_has_var(INPUT_GET, 'submit')) {  //if the form has been submitted.
    //get form data.
    $name = filter_input(INPUT_GET, 'name');
    $age = filter_input(INPUT_GET, 'age');
    //instantiate a new object, and store it in $_SESSION array.
    //$_SESSION['user'] = new User($name, $age);
    $_SESSION['user'] = serialize(new User($name, $age));
} else {  //use default values.
    //$_SESSION['user'] = new User("", 0);    
    $_SESSION['user'] = serialize(new User("", 0));    
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Example on storing objects in $_SESSION array</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <?php 
            // get user object from $_SESSION array.
            //$user = $_SESSION['user'];
            $user = unserialize($_SESSION['user']);
        ?>
        <label for="name">Name: </label><input type="text" id="name" name="name" value="<?php echo $user->getName(); ?>" placeholder="name" />
        <label for="age">Age: </label><input type="text" id="age" name="age" value="<?php echo $user->getAge(); ?>" placeholder="age" />
        <button type="submit" name="submit">Send</button>
    </form>
    <p>
    <?php
        //print user object.
        if (isset($_SESSION['user'])) {
            print_r ($user);
        }
    ?>
    </p>
    </body>
</html>