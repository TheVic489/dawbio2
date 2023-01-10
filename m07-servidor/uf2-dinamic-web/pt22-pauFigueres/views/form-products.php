<form method="POST" action="index.php">
<div class="form-group">
	<label for="id">ID:</label>
	<input type="number" name="id" id="id" placeholder="enter id" <?php echo (isset($params['user'])) ? "value='" . $params['user']->getId() . "'" : ''; ?> <?php echo (isset($params['user'])) ? 'readonly' : ''; ?>/>
</div>
<div class="form-group">
	<label for="desc">Description:</label>
	<input type="text" name="desc" id="desc" placeholder="enter description" value="<?php echo (isset($params['user'])) ? $params['user']->getDesc() : ''; ?>"/>
</div>
<div class="form-group">
	<label for="price">Price:</label>
	<input type="number" name="price" id="price" placeholder="enter price" step="any" value="<?php echo (isset($params['user'])) ? $params['user']->getPrice() : ''; ?>"/>
</div>
<div class="form-group">
	<label for="stock">Stock:</label>
	<input type="number" name="stock" id="stock" placeholder="enter stock" value="<?php echo (isset($params['user'])) ? $params['user']->getStock() : ''; ?>"/>
</div>
<div class="form-group">
<button type="submit" name="action" value='product/add' <?php echo (isset($params['user'])) ? 'disabled' : '' ?>>Add</button>
	<button type="submit" name="action" value='product/find' <?php echo (isset($params['user'])) ? 'disabled' : '' ?>>Find</button>
	<button type="submit" name='action' value='product/modify' <?php echo (!isset($params['user'])) ? 'disabled' : '' ?>>Modify</button>
	<button type="submit" name="action" value="product/remove" <?php echo (!isset($params['user'])) ? 'disabled' : '' ?>>Remove</button>
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
