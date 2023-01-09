<table>
    <h2>List all users</h2>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>password</th>
        <th>role</th>
        <th>name</th>
        <th>surname</th>
    </tr>
    <?php
    //display list of items in a table.
    $userList = $params['userList'];
    $message = $params['message'] ?? "";
    // $params contains variables passed in from the controller.
    if (count($userList) > 0) {
        foreach ($userList as $elem) {
            echo <<<EOT
        <tr>
            <td>{$elem->getId()}</td>
            <td>{$elem->getUsername()}</td>
            <td>{$elem->getPassword()}</td>
            <td>{$elem->getRole()}</td>
            <td>{$elem->getName()}</td>
            <td>{$elem->getSurname()}</td>
        </tr>               
EOT;
        }
    }
    ?>
</table>
<p><?php echo $message; ?></p>
