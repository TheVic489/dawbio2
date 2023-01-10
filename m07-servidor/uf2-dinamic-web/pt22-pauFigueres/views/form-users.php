<?php
$roles = ['staff', 'admin'];
$currentRole = (isset($params['user'])) ? $params['user']->getRole() : 'staff';
$availRoles = array();
foreach ($roles as $role) {
	if ($role !== $currentRole) {
		array_push($availRoles, $role);
	}
}
?>
<form method="POST" action="index.php">
<div class="form-group">
	<label for="id">ID:</label>
	<input type="number" name="id" id="id" placeholder="enter id" <?php echo (isset($params['user'])) ? "value='" . $params['user']->getId() ."'" : ''; ?> <?php echo (isset($params['user'])) ? 'readonly' : ''; ?>/>
</div>
<br>
<div class="form-group">
	<label for="username">Username:</label>
	<input type="text" name="username" id="username" placeholder="enter username" value="<?php echo (isset($params['user'])) ? $params['user']->getUsername() : ''; ?>"/>
</div>
<br>
<div class="form-group">
	<label for="password">Password:</label>
	<input type="text" name="password" id="password" placeholder="enter password" value="<?php echo (isset($params['user'])) ? $params['user']->getPassword() : ''; ?>"/>
</div>
<br>
<div class="form-group">
	<label for="role">Role: </label>
	<select id="role" name="role" style="display: inline-block">
		<option value="<?php echo $currentRole ?>"><?php echo ucfirst($currentRole) ?></option>
		<?php
		foreach ($availRoles as $role) {
			echo "<option value='". $role . "'>" . ucfirst($role) . "</option>";
		}
		?>
	</select>
</div>
<div class="form-group">
	<label for="name">Name:</label>
	<input type="text" name="name" id="name" placeholder="enter name" value="<?php echo (isset($params['user'])) ? $params['user']->getName() : ''; ?>"/>
</div>
<br>
<div class="form-group">
	<label for="surname">Surname:</label>
	<input type="text" name="surname" id="surname" placeholder="enter surname" value="<?php echo (isset($params['user'])) ? $params['user']->getSurname() : ''; ?>"/>
</div>
<br>
<div class="form-group">
<button type="submit" name="action" value='user/add' <?php echo (isset($params['user'])) ? 'disabled' : '' ?>>Add</button>
	<button type="submit" name="action" value='user/find' <?php echo (isset($params['user'])) ? 'disabled' : '' ?>>Find</button>
	<button type="submit" name='action' value='user/modify' <?php echo (!isset($params['user'])) ? 'disabled' : '' ?>>Modify</button>
	<button type="submit" name="action" value="user/remove" <?php echo (!isset($params['user'])) ? 'disabled' : '' ?>>Remove</button>
	<button type="reset">Reset</button>
</div>
</form>

<?php
$result = $params['result']??null;
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
} 
?>
