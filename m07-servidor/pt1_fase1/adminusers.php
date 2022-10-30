<?php
session_start();
// If role is not ADMIN, redirecto to index.php
if ($_SESSION['user_array']['role'] != 'admin') {
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
    <?php include_once "topmenu.php"; ?>
    <div class="container-fluid">
        <div class="container">
            <h2>Admin Users</h2>
            <p>
                Usuarios
            </p>
            <div class="container" style="padding-top: 1em;">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>registered</td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>staff</td>

                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            <td>admin</td>

                        </tr>                        
                    </tbody>
                </table>
            </div>
            <button title="(useless)">Funcion de admin</button>
        </div>
        <?php include_once "footer.php"; ?>
    </div>
</body>

</html>