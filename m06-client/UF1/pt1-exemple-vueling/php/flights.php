<?php
ini_set('display_errors', 1);
$info = file_get_contents('php://input');
$info = json_decode($info);

$horas_salidas = [
    "lunes" => ["8:00","12:00","18:00"],
    "martes"=>["9:00","18:00"],
    "miercoles"=>["8:30","18:30"],
    "jueves"=>["10:00","13:00","20:00"],
    "viernes"=>["7:00","12:30","19:30"],
    "sabado"=>["7:30","14:00","21:00"],
    "domingo"=>["9:30","13:30","20:30"],
];

$vuelos = [
    "barcelona-madrid"=>[
        "duracion"=>60+7,
        "precio"=>55,
        "salidas"=>"",
    ],
    "barcelona-malaga"=>[
        "duracion"=>60+28,
        "precio"=>75,
        "salidas"=>"",
    ],
    "barcelona-valencia"=>[
        "duracion" => 57,
        "precio" => 40,
        "salidas" => "",
    ],
    "madrid-malaga"=>[
        "duracion"=>60+3,
        "precio"=>50,
        "salidas" => "",
    ],
    "madrid-valencia"=>[
        "duracion"=>52,
        "precio"=>35,
        "salidas" => "",
    ],
    
    "malaga-valencia"=>[
        "duracion"=>60+6,
        "precio"=>60,
        "salidas" => "",
    ],
];

$origen = $info -> {'origen'};
$destino = $info -> {'destino'};
$dia_ida = $info -> {'dia_ida'};
$dia_vuelta = $info -> {'dia_vuelta'};
$action = $info -> {"action"};

$vuelo1 = $origen."-".$destino;//combinaciones
$vuelo2 = $destino."-".$origen;






$respuesta;

if($action == "ida"){    
    if(array_key_exists($vuelo1,$vuelos)){
        if(array_key_exists($dia_ida,$horas_salidas)){
            $respuesta = $vuelos[$vuelo1];
            $respuesta["salidas"]=$horas_salidas[$dia_ida];
        }
    }else{
        $vuelo1 = $destino."-".$origen;
        if(array_key_exists($dia_ida,$horas_salidas)){
            $respuesta = $vuelos[$vuelo1];
            $respuesta["salidas"]=$horas_salidas[$dia_ida];
        }
    }
}

else{

    if(array_key_exists($vuelo1,$vuelos)){
        if(array_key_exists($dia_vuelta,$horas_salidas)){
            $respuesta = $vuelos[$vuelo1];
            $respuesta["salidas"]=$horas_salidas[$dia_vuelta];
        }
    }else{
        $vuelo1 = $destino."-".$origen;
        if(array_key_exists($dia_vuelta,$horas_salidas)){
            $respuesta = $vuelos[$vuelo1];
            $respuesta["salidas"]=$horas_salidas[$dia_vuelta];
        }
    }

}
echo json_encode($respuesta);



