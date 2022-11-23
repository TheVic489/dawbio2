<?php
// Get fullname
if (isset($_SESSION['user_array'])) {
    $fname = $_SESSION['user_array']['fname'];
    $lname = $_SESSION['user_array']['lname'];

    $fname_upper = ucfirst($fname); // First letter upper
    $lname_upper = ucfirst($lname);

    $full_name = $fname_upper . " " . $lname_upper;
}
//

?>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container col-md-10">
        <div class="navbar-header">
            <a class="navbar-brand" href="https://www.proven.cat">Mercadona Online</a>
        </div>
        <div>
            <p class="navbar-brand" style="float: right;"><?php echo $full_name ?? ""; ?></p>
        </div>
        <?php if (!isset($_SESSION['user_array'])) { ?>
            <ul class="nav navbar-nav">
                <li class="nav-item active"><a href='index.php'>Home</a></li>
                <li class="nav-item active"><a href='login.php'>Login</a></li>
            </ul>

        <?php } elseif (isset($_SESSION['user_array'])) { ?>
            <ul class="nav navbar-nav">
                <li class="nav-item active"><a href='index.php'>Home</a></li>
                <li class="nav-item active"><a href='buy.php'>Buy</a></li>
                <li class="nav-item active"><a href='shoppingcart.php'>Shopping cart</a></li>
            </ul>
        <?php } ?>
    </div>
</nav>