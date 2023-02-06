<h2>Product Stock page</h2>
<?php if (isset($params['message'])): ?>
    <div class='alert alert-warning'>
        <strong>
            <?php echo $params['message']; ?>
        </strong>
    </div>
<?php endif ?>

<?php
require_once 'lib/Renderer.php';
require_once 'model/Product.php';

use proven\store\model\Product;

echo "<p>Product detail:</p>";
$addDisable = "";
$editDisable = "disabled";

if ($params['mode'] == 'stocks') {
    $addDisable  = "disabled";
    $editDisable = "disabled";
}

$mode = "product/{$params['mode']}";
$message = $params['message'] ?? "";
printf("<p>%s</p>", $message);

$mode = $params['mode'];
$product = $params['product'] ?? new Product();

echo proven\lib\views\Renderer::renderProductFields($product, $mode);

//var_dump($params['warehouseProduct']);
$WPlist = $params['warehouseProduct'] ?? null;
//display list in a table.
$list = $params['list'] ?? null;
if (isset($WPlist)) {
    echo <<<EOT
        <table class="table table-sm table-bordered table-striped table-hover caption-top table-responsive-sm">
        <caption>Warehouses where is stock</caption>
        <thead class='table-dark'>
        <tr>
            <th>Warehouse ID</th>
            <th>Stock</th>
        </tr>
        </thead>
        <tbody>
EOT;    
    // $params contains variables passed in from the controller.
    foreach ($WPlist as $elem) {
        echo <<<EOT
            <tr>
            <td>{$elem->getWarehouseId()}</td>
            <td>{$elem->getStock()}</td>
            </tr>               
EOT;
    }
    echo "</tbody>";
    echo "</table>";
    echo "<div class='alert alert-info' role='alert'>";
    echo count($WPlist), " elements found.";
    echo "</div>";
} else {
    echo "No data found";
}

?>  