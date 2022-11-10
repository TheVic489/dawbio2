<?php
require '../../data/credens.php';
use practica\credens as credens; 

function validateUser(array $users, string $username, string $password): array {

    $validUsername = '';
    $userFullName  = '';

    $responseBool = false;
    $responseMessage = 'Invalid credentials or user is not registered!';
    foreach($users as $usr => $credens){
        if ($usr      == $username &&
            $password == $credens['password']) {
                $validUsername = $username;
                $userFullName  = $credens['fullName'];
                $responseBool = true;
                $responseMessage = 'User has the role of ' . '"'. $credens['role'] . '".';
        }
    }

    /* return $responseMessage; */
    return ['responseMessage' => $responseMessage,
            'responseBool'    => $responseBool,
            'username'        => $validUsername,
            'fullName'        => $userFullName];
}

$entry = file_get_contents('php://input');
$entry = json_decode($entry);

$option   = $entry -> {'option'};
$userName = $entry -> {'userName'};
$password = $entry -> {'password'};
$role = '';

if ($option == 'register'){
    $role = $entry -> {'role'};
}

$response = 'Invalid credentials or user is not registered!';


if ($option == "login") {
    $users = credens\getUserCredens();

    $response = validateUser($users, $userName, $password);
}

echo json_encode($response);



