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
$empty = "";
$user = $params['user'] ?? null; //?? is the 'null coalescing operator'.
$action = $params['action'] ?? "findItem";
$result = $params['result'] ?? null;
if (is_null($user)) {
    $user = new User(0, "");
}
$disable = (($action == "findItem") || ($action == "itemForm")) ? "disabled" : "";

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
                    <input type="text" class="form-control" id="password" placeholder="Enter password" name="password" value="{$user->getPassword()}">
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="id">Age:</label>
                    <input type="number" class="form-control" id="age" placeholder="Enter age" name="age" value="{$user->getAge()}">
                </div>
                <br>
                <div class="form-group">
                <button type="submit" name="action" value="user/add">Add</button>
                <button type="submit" name="action" value="user/find">Search by username</button>
                </div>

            </fieldset>
        </form>
    </div>
    EOT;
    //}

if (!is_null($result)) {
    echo <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
}
?>