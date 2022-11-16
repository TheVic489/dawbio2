<?php
//recollim el que ens entra, en aquest cas, des de JavaScript
$info = file_get_contents('php://input');

$users=["pedro"=>"123456",
"maria"=>"123456",
"jose"=>"123456",
"pablo"=>"123456"];

$roles = ["pedro"=>"gestor",
"maria"=>"gestor",
"jose"=>"cliente",
"pablo"=>"cliente"];


//el que ens vé des de JavaScript ho passem de format JSON 
//a variable de PHP (mitjançant la funció json_decode)
$info = json_decode($info);//<-- això seria el que ens vindria des de JavaScript

$type_of_action = $info->{'action'};

if($type_of_action == "login"){
    
    $name = $info->{'u_name'};
    $pass = $info->{'u_password'};
    $rol = $info->{'u_rol'};

    $response = false;

    if(array_key_exists($name,$users)){
        if($pass == $users[$name]){
            $response=true;
        }
    }
    echo json_encode($response);

}

else if($type_of_action == "register"){

    $name = $info->{'u_name'};
    $pass = $info->{'u_password'};
    $rol = $info->{'u_rol'};

    $response = -1;

    if(!(array_key_exists($name,$users))){
        $users[$name]=$pass;
        $roles[$name]=$rol;
        
        $response=1;

    }else{
        $response = 0;
    }
    echo json_decode($response);
}



    