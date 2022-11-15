<?php

require '../../data/credens.php';
use practica\credens as credens; 

function validateRegistration($users, $userName)
{

    $response = 'User registered successfully.';

    foreach($users as $usr => $credens){
        if ($usr == $userName) {
            $response = 'Could not register, because user already exists.';
        }
    }

    return $response;
}

$entry = file_get_contents('php://input');
$entry = json_decode($entry);

$option   = $entry -> {'option'};
$fullName= $entry  -> {'fullName'};
$userName = $entry -> {'userName'};
$password = $entry -> {'password'};
$role = '';

$response = 'Invalid credentials or user is not registered!';


if ($option == "register") {
    $users = credens\getUserCredens();

    $response = validateRegistration($users, $userName);
}

echo json_encode($response);
