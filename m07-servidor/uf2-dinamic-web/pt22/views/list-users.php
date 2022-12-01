<?php $userrole = $_SESSION['userrole']??null; ?>
<?php if (!is_null($userrole)): ?>

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
    // $params contains variables passed in from the controller.
    foreach ($userList as $User) {
        echo <<<EOT
        <tr>
            <td>{$User->getId()}</td>
            <td>{$User->getUsername()}</td>
            <td>{$User->getPassword()}</td>
            <td>{$User->getRole()}</td>
            <td>{$User->getName()}</td>
            <td>{$User->getSurname()}</td>
        </tr>               
EOT;
    }
    ?>
</table>
<?php else: ?>
<p class="alert">Permission denied</p>
<?php endif ?>