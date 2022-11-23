<?php
session_start();
require_once './fn-php/fn_menu.php';

$categories = get_categories('./files/categories.txt');
var_dump($categories);    

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
    <h2>Menús del dia</h2>
            <br>
            <section class="wrap">
                <div class="column-3 columns">
                    <?php 
                    foreach ($categories as $cat) {
                        $day_menu = get_menu($cat, './files/daymenu.txt');
                        printList($day_menu);
                    }                    
                    ?>
                </div>
            </section>
        </div>
        <?php include_once "footer.php";?>
    </div>
    </body>
</html>