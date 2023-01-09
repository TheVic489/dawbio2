<script type="text/javascript">
    function submitForm(event) {
        var target = event.target;
        var buttonId = target.id;
        var myForm = document.getElementById('formProduct');
        myForm.action.value = buttonId;
        myForm.submit();
        return false;
    }
</script>
<?php
$product = $params['product'] ?? null; //?? is the 'null coalescing operator'.
$action = $params['action'] ?? "findItem";
$result = $params['result'] ?? null;
if (is_null($product)) {
    $product = new Product(0, "");
}
$disable = (($action == "findItem") || ($action == "itemForm")) ? "disabled" : "";

//if (isset($_SESSION['role'])) {
if (($_SESSION['role'] == 'admin')) {
    echo <<<EOT

<div>
    <form id="formProduct" action="index.php" method="POST">
        <fieldset>
            <legend> Products Form Form</legend>
            <div class="form-group">
                <label class="control-label col-sm-2" for="id">ID:</label>
                <input type="number" class="form-control" id="id" placeholder="Enter id" name="id" value="{$product->getId()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" value="{$product->getDescription()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="price">Price:</label>
                <input type="price" class="form-control" id="price" placeholder="Enter price" name="price" value="{$product->getPrice()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="stock">Stock:</label>
                <input type="text" class="form-control" id="stock" placeholder="Enter stock" name="stock" value="{$product->getStock()}">
            </div>

            <button type="submit" name="action" value="product/add">Add</button>
            <button type="submit" name="action" value="product/find">Find by ID</button>
            <button type="submit" name="action" value="product/modify">Modify</button>
            <button type="submit" name="action" value="product/remove">Remove</button>
        </fieldset>
    </form>
</div>
EOT;
    //}
} else {
    echo <<<EOT

    <div>
        <form id="formProduct" action="index.php" method="POST">
            <fieldset>
                <legend> Products Form Form</legend>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="id">ID:</label>
                    <input type="number" class="form-control" id="id" placeholder="Enter id" name="id" value="{$product->getId()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="description">Description:</label>
                    <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" value="{$product->getDescription()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="price">Price:</label>
                    <input type="price" class="form-control" id="price" placeholder="Enter price" name="price" value="{$product->getPrice()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="stock">Stock:</label>
                    <input type="text" class="form-control" id="stock" placeholder="Enter stock" name="stock" value="{$product->getStock()}">
                </div>
    
                <button disabled type="submit" name="action" value="product/add">Add</button>
                <button type="submit" name="action" value="product/find">Find by ID</button>
                <button disabled type="submit" name="action" value="product/modify">Modify</button>
                <button disabled type="submit" name="action" value="product/remove">Remove</button>
            </fieldset>
        </form>
    </div>
    EOT;
}
if (!is_null($result)) {
    echo <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
}
?>