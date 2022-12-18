<?php
$username = $params['username']??null;
$message  = $params['message']??null;
if (!is_null($message)) {
    echo sprintf("<p>%s</p>", $message);
}
?>
<form method="post" action="index.php">
    <fieldset>
        <legend>Login form</legend>
        <label for="username">Username:</label>
        <input type="text" name="username" id ="username" placeholder="Enter username" value="<?php if (!is_null($username)) echo $username; ?>">
        <label for="password">Password:</label>
        <input type="password" name="password" id ="password" placeholder="Enter password" value="">
        <button type="submit">Submit</button>
        <input type="text" name="action" id="action" hidden value="login">
    </fieldset>
</form>