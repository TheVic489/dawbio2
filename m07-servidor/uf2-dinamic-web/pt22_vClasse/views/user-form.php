<?php
   //get parameters passed in by controller.
   $user = $params['user']??null; 
   $action = $params['action']??"";
   $result = $params['result']??null;
   if (is_null($user)) {
       $user = new User(0, "");
   }
   //stablish button activation
   $disableAddButton = ($action == "user/search")?"disabled":"";
   $disableModifyButton = ($action == "user/form")?"disabled":"";
   $disableRemoveButton = ($action == "user/form")?"disabled":"";
   //show previous action information, if present
   if (!is_null($result)) {
       echo <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
   }   
   echo <<<EOT
   <form id="user-form" method="post" action="index.php">
    <fieldset><legend>User form</legend>
        <input type="hidden" name="id" id="id" value="{$user->getId()}"/>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" placeholder="enter username" value="{$user->getUsername()}"/>
        <label for="password">Password: </label>
        <input type="text" name="password" id="password" placeholder="enter password" value="{$user->getPassword()}"/>
        <label for="role">Role: </label>
        <input type="text" name="role" id="role" placeholder="enter role" value="{$user->getRole()}"/>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" placeholder="enter name" value="{$user->getName()}"/>
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname" placeholder="enter surname" value="{$user->getSurname()}"/>
   </fieldset>

        <button type="submit" id="findItem" name="action" value="user/search">Find</button>
        <button type="submit" id="addItem" name="action" value="user/add" {$disableAddButton}>Add</button>
        <button type="submit" id="modifyItem" name="action" value="user/modify" {$disableModifyButton}>Modify</button>
        <button type="submit" id="removeItem" name="action" value="user/remove" {$disableRemoveButton}>Remove</button>

</form>
EOT;
