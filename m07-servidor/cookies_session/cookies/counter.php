<?php
    // the setcookie() function must appear before the <html> tag
    if (isset($_COOKIE['counter'])) {
        $cookie_value=$_COOKIE['counter']+1;
        setcookie('counter', $cookie_value, time() + 365 * 24 * 60 * 60); // 1 year
    } 
    else { 
        $cookie_value=1;
        setcookie('counter', $cookie_value, time() + 365 * 24 * 60 * 60); // 1 year
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>counter</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <h1>counter</h1>
        
        <p>Page views: <?php echo $cookie_value; ?></p>        
    </body>
</html>
