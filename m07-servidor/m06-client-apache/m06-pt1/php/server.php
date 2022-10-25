<?php

//variables, arrays,...
$users = ["user1", "user2", "user3"];
$pass  = ["pass1", "pass2", "pass3" ];
$rols  = ["client", "gestor"];

//recoger las peticiones
$entrada=file_get_contents('php://input');

//paso de JSON, cadena de texto, a variable de PHP
$entrada=json_decode($entrada);

// Si es Login
if ($entrada -> {'action'} == 'login') {
  $usr = $entrada -> {'username'};
  $psw = $entrada -> {'password'};

  $usr_result = in_array($usr, $users);
  $psw_result = in_array($psw, $pass);

  $response = "";
  if ($usr_result and $psw_result ) {
	//echo json_encode("Login Succesful <br>");
	$response=["Success", " rol: $rols[0]"];
  } else {
	$response=["<strong>Wrong credentials</strong>"];
  }
  
  
}

// si es register
if ($entrada -> {'action'} == 'register') {
  $fullName = $entrada -> {'nomComplet'};
  $newUrs   = $entrada -> {'newUserName'};
  $newPsw   = $entrada -> {'newPsw'};
}

 //envio del resultado imprimiéndolo: variable PHP a JSON
echo json_encode($response);

?>