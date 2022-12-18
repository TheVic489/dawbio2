
<table>
    <h2>List all users</h2>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>role</th>
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
                <td>{$User->getId()}</td>
                <td>{$User->getUsername()}</td>
                <td>{$User->getRole()}</td>
            </tr>               
EOT;

            }


        }

    ?>
</table>
<p>
    <?php echo $message; ?>
</p>
