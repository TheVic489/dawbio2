<table>
    <h2>List all Products</h2>
    <tr>
        <th>id</th>
        <th>description</th>
        <th>price</th>
        <th>stock</th>
    </tr>
    <?php
        //display list of items in a table.
        $products_list = $params['products_list'];
        $message = $params['message'] ?? "";
        // $params contains variables passed in from the controller.
        if (count($products_list) > 0) {
            foreach ($products_list as $Product) {
                echo <<<EOT
            <tr>
                <td>{$Product->getId()}</td>
                <td>{$Product->getDescription()}</td>
                <td>{$Product->getPrice()}</td>
                <td>{$Product->getStock()}</td>
            </tr>               
EOT;

            }


        }

    ?>
</table>
<p>
    <?php echo $message; ?>
</p>
