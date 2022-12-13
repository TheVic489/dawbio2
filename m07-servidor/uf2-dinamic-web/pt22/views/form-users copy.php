<!-- <form action="index.php" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="username">Username:</label>
        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="surname">Surname:</label>
        <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" required>
    </div>
    <button type="submit" name="action" value="user/add">Submit</button>
</form> -->
<script type="text/javascript">
function submitForm(event) {
    var target = event.target;
    var buttonId = target.id;
    var myForm = document.getElementById('item-form');
    myForm.action.value = buttonId;
    myForm.submit();
    return false;
}
</script>
<?php
   $user = $params['user']??null;  //?? is the 'null coalescing operator'.
   $action = $params['action']??"finduser";
   $result = $params['result']??null;
   if (is_null($user)) {
       $user = new User(0, "");
   }
   $disable = (($action == "finduser")||($action == "userForm"))?"disabled":"";
   if (!is_null($result)) {
       echo <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
   }   
   echo <<<EOT
   <form id="user-form" method="get" action="index.php">
    <fieldset>
    <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="password">Password:</label>
    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="surname">Surname:</label>
    <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" required>
</div>
   </fieldset>
    <fieldset>
        <button type="button" id="finduser" name="finduser" onclick="submitForm(event);return false;">Find</button>
        <button type="button" id="user/add" name="user/add value="user/add" onclick="submitForm(event);return false;">Add</button>
        <button type="button" id="modifyuser" name="modifyuser" {$disable} onclick="submitForm(event);return false;">Modify</button>
        <button type="button" id="removeuser" name="removeuser" {$disable} onclick="submitForm(event);return false;">Remove</button>
        <input name="action" id="action" hidden="hidden" value="add"/>
    </fieldset>
</form>
EOT;
