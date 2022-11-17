<?php
namespace practica\credens;

function getUserCredens(): array {
    $users = [
        'userOne' => [
            'fullName' => 'Dániel Májer',
            'password' => 'password1',
            'role'     => 'gestor'
        ],
        'userTwo' => [
            'fullName' => 'Saitama Sama',
            'password' => 'password2',
            'role'     => 'client'
        ],
    ];
    

    return $users;
}
