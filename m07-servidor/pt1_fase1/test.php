<?php
require_once './fn-php/fn_users.php';
session_start();
// Search success
$result = searchUser("user4", "pass4");
echo "<pre>";
print_r($result['username']);
echo "<pre>";
$_SESSION["user_array"] = $result;

print_r($_SESSION["user_array"]['role']);


//  Search fail
$result = searchUser("fakeuser", "pass123");
echo "<pre>";
print_r($result);
echo "<pre>";

echo "<pre>";

// Regisster succes
$registerResult = registerUser('pepito', 'pass123123', 'registered', 'pepe', 'rodriguez');
echo "<pre>";
var_dump($registerResult);
echo "<pre>";
 
// Regisster fail
$registerResult = registerUser('pepito', 'pass123123', 'registered', 'pepe', 'rodriguez');
echo "<pre>";
var_dump($registerResult);
echo "<pre>";