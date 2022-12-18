<form method="get" action="index.php">
    <fieldset>
        <legend>Confirm Logout?</legend>
        <button  <?php if (!isset($_SESSION['username'])) { echo 'disabled'; } ?> type="submit" name="action"  value="logout">Yes</button>
    </fieldset>
</form>

<?php
if (!isset($_SESSION['username'])) { echo '<p>Not logged yet!</p>'; } 
?>