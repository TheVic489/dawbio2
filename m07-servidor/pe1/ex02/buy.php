<?php
require_once './fn-php/fn_prodcuts.php';
session_start();
// If not login, redirect to index
if (!isset($_SESSION["user_array"])) {
    header("Location: index.php");
}

// IF comanda session doesn't exits. Creats a empty one.
if (!isset($_SESSION["comanda"])) {
    $_SESSION["comanda"] = [];
}

// Read prodcuts from file, gives array.
$products_array = get_products("./files/products.txt");

//When pressing "Comprar" button, redirects to shoping cart
if (filter_has_var(INPUT_POST, "loginsubmit")) {
    header("Location: shoppingcart.php");
}
//When pressing "netejar comanda" button, clears session data.
if (filter_has_var(INPUT_POST, "clear")) {
    $_SESSION["comanda"] = [];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>DAWBI-M07-Pe1</title>
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
            <h2>Buy Products!</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <!-- For each product, create an option -->
                <?php foreach ($products_array as $product) { ?>
                    <fieldset>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <b> <?php echo $product[0] ?></b>
                            <p> <?php echo "Preu: " . $product[1] ?></p>

                            <span style="float:right">
                                <label name="product"> Amount:</label>
                                <input name="<?php echo $product[0] ?>" type="number" max="100">
                                <input type="submit" value="Add to cart" name="productsubmit" class="btn btn-primary"></input>
                            </span>
                        </div>
                    </fieldset>
                    <?php
                    // When click on adding prodcut, get de amount.
                    if (filter_has_var(INPUT_POST, "productsubmit")) {

                        $amount = (filter_input(INPUT_POST, $product[0],));
                        # Item (array of all products, and if we selected an amount, have the value)
                        $item = [$product[0], $product[1], $amount];
                        // If item doesn't have amount, dont add to cart.
                        if (!($item[2] == "")) {
                            array_push($_SESSION["comanda"], $item);
                        }
                    };
                    ?>
                <?php } ?>
                <input type="submit" value="Comprar" name="loginsubmit" class="btn btn-success"></input>
                <input type="submit" value="Netejar Comanda" name="clear" class="btn btn-warning"></input>
            </form>
        </div>
        <?php include_once "footer.php"; ?>
    </div>
</body>

</html>