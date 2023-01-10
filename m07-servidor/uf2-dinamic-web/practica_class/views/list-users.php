<?php //$userrole = $_SESSION['userrole']??null; ?>
<?php //if (!is_null($userrole)): ?>

<table>
    <h2>List all users</h2>
    <tr>
        <th>id</th>
        <th>username</th>
        <th>role</th>
    </tr>
    <?php
    //display list of items in a table only if the role is staff or admin.
    $userList = $params['userList'];
    $message = $params['message']??'';
    if(count($userList)>0){    foreach ($userList as $elem) {
        // if($elem->getRole()=="staff"||$elem->getRole()=="admin"){
        echo <<<EOT
        <tr>
            <td>{$elem->getId()}</td>
            <td>{$elem->getUsername()}</td>
            <td>{$elem->getRole()}</td>
        </tr>               
        EOT;
    //}
    }}
    // $params contains variables passed in from the controller.
    //<td>{$elem->getPassword()}</td>
    //<td>{$elem->getName()}</td>
    //<td>{$elem->getSurname()}</td>
    ?>
</table>
<?php echo $message ?>
<?php //else: ?>
<!-- <p class="alert">Permission denied</p> -->
<?php //endif ?>