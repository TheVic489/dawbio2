<?php
require_once 'lib/Renderer.php';
require_once 'model/Warehouse.php';

use proven\store\model\Warehouse;

echo "<p>Warehouse detail page</p>";
$addDisable = "";
$editDisable = "disabled";

if ($params['mode']!='add') {
    $addDisable = "disabled";
    $editDisable = "";
}

$mode = "warehouse/{$params['mode']}";
$message = $params['message'] ?? "";
printf("<p>%s</p>", $message);

if (isset($params['mode'])) {
    printf("<p>mode: %s</p>", $mode);
}

$warehouse = $params['warehouse'] ?? new Warehouse();
echo "<form method='post' action=\"index.php\">";
echo proven\lib\views\Renderer::renderWarehouseFields($warehouse);
echo "<button type='submit' name='action' value='warehouse/modify' $editDisable>Modify</button>";
echo "</form>";