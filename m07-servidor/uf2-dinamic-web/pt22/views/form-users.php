<script type="text/javascript">
    function submitForm(event) {
        var target = event.target;
        var buttonId = target.id;
        var myForm = document.getElementById('formUser');
        myForm.action.value = buttonId;
        myForm.submit();
        return false;
    }
</script>
<?php
$user = $params['user'] ?? null; //?? is the 'null coalescing operator'.
$action = $params['action'] ?? "findItem";
$result = $params['result'] ?? null;
if (is_null($user)) {
    $user = new User(0, "");
}
$disable = (($action == "findItem") || ($action == "itemForm")) ? "disabled" : "";

//if (isset($_SESSION['role'])) {
    if (($_SESSION['role'] == 'admin')) {
        echo <<<EOT

    <div>
        <form id="formUser" action="index.php" method="POST">
            <fieldset>
                <legend> User Form</legend>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="username">Username:</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="{$user->getUsername()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="{$user->getPassword()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{$user->getName()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="surname">Surname:</label>
                    <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" value="{$user->getSurname()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="id">ID:</label>
                    <input type="number" class="form-control" id="id" placeholder="Enter id" name="id" value="{$user->getId()}">
                </div>

                <button type="submit" name="action" value="user/add">Add</button>
                <button type="submit" name="action" value="user/find">Find by ID</button>
                <button type="submit" name="action" value="user/modify">Modify</button>
                <button type="submit" name="action" value="user/remove">Remove</button>
            </fieldset>
        </form>
    </div>
    EOT;
    //}
}else {
    echo <<<EOT

<div>
    <form id="formUser" action="index.php" method="POST">
        <fieldset>
            <legend> User Form</legend>
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="{$user->getUsername()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="{$user->getPassword()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{$user->getName()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" value="{$user->getSurname()}">
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="role">Role:</label>
            <input type="text" class="form-control" id="role" placeholder="Enter role" name="role" value="{$user->getRole()}">
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="id">ID:</label>
                <input type="number" class="form-control" id="id" placeholder="Enter id" name="id" value="{$user->getId()}">
            </div>

            <button disabled type="submit" name="action" value="user/add">Add</button>
            <button type="submit" name="action" value="user/find">Find by ID</button>
            <button disabled type="submit" name="action" value="user/modify">Modify</button>
            <button disabled type="submit" name="action" value="user/remove">Remove</button>
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