<?php
session_start();
?>
<nav class="navbar navbar-default">
    <div class="container col-md-10">
        <div class="navbar-header">
            <a class="navbar-brand" href="https://www.proven.cat">ProvenSoft</a>
        </div>
        <?php if (!isset($_SESSION['user_array'])) { ?>
            <ul class="nav navbar-nav">
                <li><a href='index.php'>Home</a></li>
                <li><a href='daymenu.php'>Day Menu</a></li>
                <li><a href='register.php'>Register</a></li>
                <li><a href='login.php'>Login</a></li>
            </ul>
        
        <?php } elseif (isset($_SESSION['user_array']) && ($_SESSION['user_array']['role'] == 'registered')) { ?>
            <ul class="nav navbar-nav">
                <li><a href='index.php'>Home</a></li>
                <li><a href='daymenu.php'>Day Menu</a></li>
                <li><a href='viewmenus.php'>View Menus</a></li>
                <li><a href='logout.php'>Log out</a></li>
            </ul>
        <?php } elseif (isset($_SESSION['user_array']) && ($_SESSION['user_array']['role'] == 'staff')) { ?>
            <ul class="nav navbar-nav">
                <li><a href='index.php'>Home</a></li>
                <li><a href='daymenu.php'>Day Menu</a></li>
                <li><a href='viewmenus.php'>View Menus</a></li>
                <li><a href='adminmenus.php'>Admin Menus</a></li>
                <li><a href='logout.php'>Log out</a></li>
            </ul>
        <?php } elseif (isset($_SESSION['user_array']) && ($_SESSION['user_array']['role'] == 'admin')) { ?>
            <ul class="nav navbar-nav">
                <li><a href='index.php'>Home</a></li>
                <li><a href='daymenu.php'>Day Menu</a></li>
                <li><a href='viewmenus.php'>View Menus</a></li>
                <li><a href='adminmenus.php'>Admin Menus</a></li>
                <li><a href='adminusers.php'>Admin Users</a></li>
                <li><a href='logout.php'>Log out</a></li>
            </ul>
        <?php } ?>
        </div>
</nav>



