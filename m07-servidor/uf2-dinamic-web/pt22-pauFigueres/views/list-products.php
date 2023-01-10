
<table>
    <h2>List all products</h2>
    <tr>
        <th>id</th>
        <th>desc</th>
        <th>price</th>
    </tr>
    <?php
        //display list of items in a table.
        $prodList = $params['prodList'];
        $message = $params['message'] ?? "";
        // $params contains variables passed in from the controller.
        if (count($prodList) > 0) {
            foreach ($prodList as $Prod) {
                echo <<<EOT
            <tr>
                <td>{$Prod->getId()}</td>
                <td>{$Prod->getDesc()}</td>
                <td>{$Prod->getPrice()}</td>
            </tr>               
EOT;

            }


        }

    ?>
</table>
<p>
    <?php echo $message; ?>
</p>
