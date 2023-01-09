<?php

$session = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;

if(!$session){
    session_start();
};

$session_started = isset($_SESSION['username']);

?>
<nav>
    <ul>
    <?php
    if(!$session_started){
        echo "<li><a href='index.php?action=home'>Home</a></li>"; 
        echo "<li><a href='index.php?action=login/form'>Login</a></li>";   
        echo "<li><a href='index.php?action=product/listAll'>List all products</a></li>";
            
    }
?>
<?php
    if($session_started){
        if(in_array($_SESSION['rol'], ['staff'])){
            echo "<li><a href='index.php?action=home'>Home</a></li>"; 
            echo "<li><a href='index.php?action=product/listAll'>List all products</a></li>";
            echo "<li><a href='index.php?action=product/form'>Product form</a></li>";
            echo "<li><a href='index.php?action=user/listAll'>List all users</a></li>";
            echo "<li><a href='index.php?action=logout'>Logout</a></li>";                   
        };
    }
?>

<?php
    if($session_started){
        if(in_array($_SESSION['rol'], ['admin'])){
            echo "<li><a href='index.php?action=home'>Home</a></li>"; 
            echo "<li><a href='index.php?action=product/listAll'>List all products</a></li>";
            echo "<li><a href='index.php?action=product/form'>Product form</a></li>";
            echo "<li><a href='index.php?action=user/listAll'>List all users</a></li>";
            echo "<li><a href='index.php?action=user/form'>User form</a></li>"; 
            echo "<li><a href='index.php?action=logout'>Logout</a></li>";   
                             
        };
    }
?>
</nav>