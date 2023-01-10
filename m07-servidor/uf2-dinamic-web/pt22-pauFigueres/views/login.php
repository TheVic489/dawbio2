<?php
$message = $params['message']??null;
?>
<form action="index.php" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="username">Username:</label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
	<button type="submit" name="action" value="user/login" <?php echo (isset($_SESSION['username'])) ? 'disabled' : '' ?> >Submit</button>
	<span><?php echo (is_null($message)) ? $message : ''; ?></span>
	<span><?php echo (isset($_SESSION['username'])) ? 'Already logged in' : ''; ?></span>
</form>
