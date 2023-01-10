<?php
require_once './model/Model.php';
$model = new Model();


// $encontrado = $model->searchProductById("22");
// var_dump($encontrado);



$array_login = array("user3","pass3");
$allusers = $model->validate($array_login);
var_dump($allusers[1]);



// $allusers = $model->searchAllUsers();
// echo '<pre>';
// echo var_dump($allusers);
// echo '</pre>';