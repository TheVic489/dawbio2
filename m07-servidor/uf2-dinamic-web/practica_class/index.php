<?php session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);   
    ini_set('error_reporting', E_ALL);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Store application</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> 
  </head>
  <body>
      <?php
        //include "views/topmenu.html";
        include "views/topmenu.php";
        if (isset($_SESSION['username'])) {
            echo "Logged user: ".$_SESSION['username'];
            // echo "Logged user: ".$_SESSION['rol'];
        }
      ?>
      <h2>Store application</h2>
      <?php
        //dynamic html content generated here by controller.
        require_once 'controllers/MainController.php';
        (new MainController())->processRequest();
      ?>
  </body>
</html>