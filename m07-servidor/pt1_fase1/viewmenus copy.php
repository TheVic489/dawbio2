<?php
session_start();
require_once './fn-php/fn_menu.php';

if (!isset($_SESSION['user_array'])) {
    header("Location: index.php");
    exit;
}
$categories = get_categories('/files/categories.txt');

foreach ($categories as $cat) {
     get_courses_by_categories('appetiser', './files/menu.txt');
}
$appetiser   = get_courses_by_categories('appetiser', './files/menu.txt');
$firstcourse = get_courses_by_categories('firstcourse', './files/menu.txt');
$maincourse  = get_courses_by_categories('maincourse', './files/menu.txt');
$dessert     = get_courses_by_categories('dessert', './files/menu.txt');
$drink       = get_courses_by_categories('drink', './files/menu.txt');


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
        <div class="container" style="text-align: center;">
        <h2 style="text-align: left">Main Courses</h2>
        <div class="container-fluid" id="maincourse_table">
            <?php if (count($maincourse) > 0) : ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($maincourse as $row) : array_map('htmlentities', $row); ?>
                            <tr>
                                <td><?php echo implode('</td><td>', $row); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        </div>
        
        <?php include_once "footer.php"; ?>
    </div>
</body>

</html>