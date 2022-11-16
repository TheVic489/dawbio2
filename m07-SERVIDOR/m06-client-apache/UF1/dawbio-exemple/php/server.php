<?php

//variables, arrays,...


//recoger las peticiones
$entrada=file_get_contents('php://input');

//paso de JSON, cadena de texto, a variable de PHP
$entrada=json_decode($entrada);

//var_dump($entrada);
/*
let user2={ //objecte JS
      nom: name,
      curs: course  
    };
*/
$name= $entrada->{'nom'};
//var_dump($name);
$course= $entrada->{'curs'};
//var_dump($course);

//codigo de PHP hago lo que sea y al final necesito
//enviar el siguiente array
$array=["dawbio2", "daw2"];


//envio del resultado imprimiéndolo: variable PHP a JSON
echo json_encode($array);







?>