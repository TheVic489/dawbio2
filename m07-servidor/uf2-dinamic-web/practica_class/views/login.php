
   <form  method="post" action="index.php">
    <fieldset>
        <label for="username">Username: </label><input type="text" name="username" id="username" placeholder="enter username"/>
        <label for="password">Password: </label><input type="text" name="password" id="password" placeholder="enter password" />
   </fieldset>
    <fieldset>
        <button type="submit" name="action" value="user/login">Login</button>
        <!-- <input name="action" id="action" hidden="hidden" value="add"/> -->
        <?php //$arrays = $params['login']; $existe = $params['correcto'];var_dump($arrays[0]);var_dump($existe);?>
    </fieldset>
</form>
<?php


