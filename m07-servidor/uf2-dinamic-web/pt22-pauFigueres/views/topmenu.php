<nav>
    <ul>
        <li><a href="index.php?action=home">Home</a></li>
        <li><a href="index.php?action=product/listAll">List all products</a></li>
		<?php echo (isset($_SESSION['role']) && ($_SESSION['role'] === 'staff' || $_SESSION['role'] === 'admin')) ? '<li><a href="index.php?action=product/form">Product form</a></li>' : '' ?>
		<?php echo (isset($_SESSION['role']) && ($_SESSION['role'] === 'staff' || $_SESSION['role'] === 'admin')) ? '<li><a href="index.php?action=user/listAll">List users</a></li>' : '' ?>
		<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? '<li><a href="index.php?action=user/form">User form</a></li>' : '' ?>
        <li><a href="index.php?action=login/form" class="right-nav">Login</a></li>
		<?php echo (isset($_SESSION['username'])) ? '<li><a href="index.php?action=logout" class="right-nav">Logout</a></li>' : ''; ?>
		<?php echo (isset($_SESSION['username'])) ? "<li class='right-nav'><p>" . $_SESSION['username'] . "</p></li>" : ''; ?>
    </ul>
</nav>
