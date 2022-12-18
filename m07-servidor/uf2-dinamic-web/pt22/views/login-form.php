<form method="post" action="index.php">
    <fieldset>
        <legend>Login form</legend>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Enter username">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter password" value="">
        <button type="submit" name="action" <?php if (isset($_SESSION['username'])) { echo 'disabled'; } ?> value="login/submit">Submit</button>
    </fieldset>
</form>

<?php
if (isset($_SESSION['username'])) { echo '<p>Already logged!</p>'; } 

$username = $params['username'] ?? null;
$message = $params['message'] ?? null;
if (!is_null($message)) {
    echo sprintf("<p>%s</p>", $message);
}
?>