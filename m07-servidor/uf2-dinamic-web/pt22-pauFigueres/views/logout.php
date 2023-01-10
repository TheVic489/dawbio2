<form action="index.php" method="POST">
	<button type="submit" name="action" value="user/logout" <?php echo (isset($_SESSION['username'])) ? '' : 'disabled' ?> >Logout</button>
	<button type="submit" name="action" value="home">Cancel</button>
</form>
