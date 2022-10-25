<?php
require_once 'lib/fnDrinks.php';
require_once 'lib/fnHtmlDom.php';

use proven\drinks as drinks;
use proven\htmldom as htmldom;

//initialize variables
$error = "";
//get data sent from form
if (filter_has_var(INPUT_POST, 'btnSubmit')) { //assess that form has been sent
    //get selected drink from data sent by form
    $selectedDrink = trim(\filter_input(INPUT_POST, 'drink', FILTER_SANITIZE_STRING));
    try {
        //get drink price from array of data
        $price = drinks\getDrinkPrice($selectedDrink);
    } catch (\Exception $ex) { //catch error when drink name is not found
        $error = "drink $selectedDrink: not found";
        $price = 0.0;
    }
} else {
    $selectedDrink = "";
        $price = 0.0;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Drinks order form</title>
        <link rel="stylesheet" href="css/drinks.css" />
    </head>
    <body>
        <h2>Welcome to Organic Pub</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset>
                <legend>Order your drinks here</legend> 
                <div>
                    <label for="drink">Drink: </label>
                    <!-- write a selector for drinks -->
                    <?php
                    //get all drink names
                    $allDrinks = drinks\getAllDrinks();
                    //DEBUG: add a test drink not in initial array to check drink not found error (REMOVE FOR PRODUCTION!!!)
                    array_push($allDrinks, "milk");
                    //echo selector with all drink names
                    htmldom\renderSelector("drink", $allDrinks, $selectedDrink);
                    ?>
                    <button type="submit" name="btnSubmit" value="submit">Submit</button>
                </div>
            </fieldset>
            <fieldset>
                <legend>Receipt</legend> 
                <div>
                    <label for="selectedDrink">Drink: </label>
                    <input type="text" name="selectedDrink" disabled="disabled" value="<?php echo $selectedDrink ?? ""; ?>" />
                </div>
                <div>
                    <label for="price">Unit price: </label>
                    <input type="text" name="price" disabled="disabled" value="<?php echo number_format($price ?? 0.0, 2); ?>" />
                </div>
            </fieldset>
        </form>
        <?php if (isset($error) && strlen($error)>0) : ?>
        <p class="error"><?php echo $error ?? "";?></p>
        <?php endif; ?>
    </body>
</html>
