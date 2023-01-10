<!-- <form action="index.php" method='post'>
<input type="text" >
<input type="text">
<input type="text">
<input type="text">
<input type="text">
<input type="text">
<input type="text">
<input type="submit" name="action" value="product/add"></input>
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
   $action = $params['action']??"findItem";
   $result = $params['result']??null;
   if (is_null($user)) {
       $user = new User(0, "");
   }
   $disable = (($action == "findItem")||($action == "itemForm"))?"disabled":"";
   if (!is_null($result)) {
       echo <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
   } 
echo <<<EOT
   <form id="item-form" method="post" action="index.php">
    <fieldset>
        <label for="id">Id: </label><input type="text" name="id" id="id" placeholder="enter id" value="{$user->getId()}"/>
        <label for="username">Username: </label><input type="text" name="username" id="username" placeholder="enter username" value="{$user->getUsername()}"/>
        <label for="password">Password: </label><input type="text" name="password" id="password" placeholder="enter password" value="{$user->getPassword()}"/>
        <label for="role">Role: </label><input type="text" name="role" id="role" placeholder="enter role" value="{$user->getRole()}"/>
        <label for="name">Name: </label><input type="text" name="name" id="name" placeholder="enter name" value="{$user->getName()}"/>
        <label for="surname">Surname: </label><input type="text" name="surname" id="surname" placeholder="enter surname" value="{$user->getSurname()}"/>

   </fieldset>
    <fieldset>
        <button type="button" id="findUser" name="findUser" onclick="submitForm(event);return false;">Find</button>
        <button type="button" id="user/addUser" name="user/addUser" onclick="submitForm(event);return false;">Add</button>
        <button type="button" id="modifyUser" name="modifyUser" {$disable} onclick="submitForm(event);return false;">Modify</button>
        <button type="button" id="removeUser" name="removeUser" {$disable} onclick="submitForm(event);return false;">Remove</button>
        <input name="action" id="action" hidden="hidden" value="add"/>
    </fieldset>
</form>
EOT;
?>
