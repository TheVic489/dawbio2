
<form action="index.php" method="POST">
    <fieldset>
    <legend> Add user</legend>
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
    <div class="form-group">
        <label class="control-label col-sm-2" for="id">ID:</label>
        <input type="number" class="form-control" id="id" placeholder="Enter id" name="id" required>
    </div>
    <button type="submit" name="action" value="user/add">Submit</button>
    </fieldset>
</form>

<?php
$result = $params['result']??null;
if (!is_null($result)) {
    echo <<<EOT
    <div><p class="alert">$result</p></div>
EOT;
} 
?>