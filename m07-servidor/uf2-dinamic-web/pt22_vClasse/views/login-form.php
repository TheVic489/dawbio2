<?php
   //get parameters passed in by controller.
   $user = $params['user']??null; 
   $action = $params['action']??"";
   $result = $params['result']??null;
   if (is_null($user)) {
       $user = new User(0, "");
   }
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
    </fieldset>

    <button type="submit" id="login" name="action" value="user/login">Send</button>
    </form>
EOT;
