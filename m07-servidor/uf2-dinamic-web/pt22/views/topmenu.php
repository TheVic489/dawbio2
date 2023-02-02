<nav>
    <ul>
        <li><a href="index.php?action=home">Home</a></li>
        <li><a href="index.php?action=product/listAll">List all products</a></li>
        <li><a href="index.php?action=product/form">Product form</a></li>
        <li><a href="index.php?action=user/listAll">List all users</a></li>
        <li><a href="index.php?action=user/form">User form</a></li>
        <li><a href="index.php?action=login/form" class="right-nav">Login</a></li>
        <li><a href="index.php?action=logout/form" class="right-nav">Logout</a></li>
        <?php
    if (isset($_SESSION['username'])) {
        echo "Logged user: ".$_SESSION['username'];
        } ?>
    </ul>
    
</nav>