<?php

require_once './model/Model.php';

$model = new Model();

$allUsers = $model->searchAllUsers();
echo "<pre>";
print_r($allUsers);
echo "</pre>";
