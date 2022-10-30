<?php
session_start();
// Array with permited roles
$permitted_roles = ['staff', 'admin'];
$role = $_SESSION['user_array']['role'];
// If role, is not in permited roles, redirecto to index.php
if (!in_array($role, $permitted_roles)) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DAWBI-M07-Pt11</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include_once "topmenu.php";?>
    <div class="container-fluid">
        <div class="container">
        <h2>Admin Menus</h2>
<p>
    menu de administradores
</p>
<button title="(useless)">Funcion de admin</button>
        </div>
        <?php include_once "footer.php";?>
    </div>
    </body>
</html>

