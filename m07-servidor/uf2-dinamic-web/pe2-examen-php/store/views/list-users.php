<table>
    <h2>List all users</h2>
    <tr>
        <th>ID</th>
        <th>Age</th>
    </tr>
    <?php
        //display list of items in a table.
        $userList = $params['userList'];
        $message = $params['message'] ?? "";
        // $params contains variables passed in from the controller.
        if (count($userList) > 0) {
            foreach ($userList as $User) {
                echo <<<EOT
            <tr>
                <td>{$User->getUsername()}</td>
                <td>{$User->getAge()}</td>
            </tr>               
EOT;

            }


        }

    ?>
</table>
<p>
    <?php echo $message; ?>
</p>
